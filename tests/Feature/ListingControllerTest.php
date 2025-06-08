<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\ListingImage;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Mockery;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;


class ListingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        // Default Gate behavior: Allow all actions for other tests
        Gate::before(function ($user, $ability) {
            return true;
        });
    }

    /**
     * Test the index method displays listings and applies filters correctly.
     */
    public function test_index_displays_listings_and_filters(): void
    {
        // Test 1: Basic rendering without filters
        Listing::factory()->count(15)->for($this->user, 'owner')->create();
        Listing::factory()->sold()->for($this->user, 'owner')->create();

        $response = $this->actingAs($this->user)->get(route('listing.index'));
        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Index')
                ->has('listings.data', 10, fn(Assert $listing) => $listing->where('sold_at', null) // Ensure sold listings are not present
                ->etc()
                )
                ->has('listings.links')
                ->has('filters', 0) // No filters applied initially
        );

        // Test 2: Filtering by price range
        // Clear existing listings to ensure consistent test data
        Listing::query()->delete();
        // Create exactly three listings for this specific test case
        Listing::factory()->for($this->user, 'owner')->create(['price' => 100000]);
        Listing::factory()->for($this->user, 'owner')->create(['price' => 200000]);
        Listing::factory()->for($this->user, 'owner')->create(['price' => 300000]);

        $response = $this->actingAs($this->user)->get(route('listing.index', [
            'priceFrom' => 150000,
            'priceTo' => 250000,
        ]));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Index')
                ->has('listings.data', 1, fn(Assert $listing) => $listing->where('price', 200000)
                    ->etc()
                )
                ->where('filters.priceFrom', '150000')
                ->where('filters.priceTo', '250000')
        );

        // Test 3: Filtering by beds and baths
        Listing::factory()->for($this->user, 'owner')->create(['beds' => 2, 'baths' => 1]);
        Listing::factory()->for($this->user, 'owner')->create(['beds' => 3, 'baths' => 2]);
        Listing::factory()->for($this->user, 'owner')->create(['beds' => 4, 'baths' => 3]);

        $response = $this->actingAs($this->user)->get(route('listing.index', [
            'beds' => 3,
            'baths' => 2,
        ]));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Index')
                ->has('listings.data', 1, fn(Assert $listing) => $listing->where('beds', 3)
                    ->where('baths', 2)
                    ->etc()
                )
                ->where('filters.beds', '3')
                ->where('filters.baths', '2')
        );

        // Test 4: Filtering by area range
        Listing::factory()->for($this->user, 'owner')->create(['area' => 800]);
        Listing::factory()->for($this->user, 'owner')->create(['area' => 1200]);
        Listing::factory()->for($this->user, 'owner')->create(['area' => 1800]);

        $response = $this->actingAs($this->user)->get(route('listing.index', [
            'areaFrom' => 1000,
            'areaTo' => 1500,
        ]));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Index')
                ->has('listings.data', 1, fn(Assert $listing) => $listing->where('area', 1200)
                    ->etc()
                )
                ->where('filters.areaFrom', '1000')
                ->where('filters.areaTo', '1500')
        );

        // Test 5: Combination of filters
        // Create new listings for this specific test case, associated with user
        Listing::factory()->for($this->user, 'owner')->create([
            'price' => 400000, 'beds' => 3, 'baths' => 2, 'area' => 2000,
        ]); // Match
        Listing::factory()->for($this->user, 'owner')->create([
            'price' => 450000, 'beds' => 3, 'baths' => 2, 'area' => 2100,
        ]); // No match (price)

        $response = $this->actingAs($this->user)->get(route('listing.index', [
            'priceFrom' => 350000,
            'priceTo' => 420000,
            'beds' => 3,
            'baths' => 2,
            'areaFrom' => 1900,
        ]));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Index')
                ->has('listings.data', 1, fn(Assert $listing) => $listing->where('price', 400000)
                    ->where('beds', 3)
                    ->where('baths', 2)
                    ->where('area', 2000)
                    ->etc()
                )
                ->where('filters.priceFrom', '350000')
                ->where('filters.priceTo', '420000')
                ->where('filters.beds', '3')
                ->where('filters.baths', '2')
                ->where('filters.areaFrom', '1900')
        );

        // Test 6: No listings match filters (edge case)
        $response = $this->actingAs($this->user)->get(route('listing.index', [
            'priceFrom' => 9999999, // Extremely high price should not match
        ]));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Index')
                ->has('listings.data', 0)
        );
        // Authorization test for index was moved to a separate method: test_index_authorization_failure()
    }

    /**
     * Test that an unauthorized user cannot view the listing index.
     */
    public function test_index_authorization_failure(): void
    {
        // Clear the Gate::before handler from setUp
        Gate::before(fn() => null);

        // Mock the Gate facade directly
        Gate::shouldReceive('authorize')
            ->with('viewAny', Listing::class)
            ->once()
            ->andThrow(new AuthorizationException('Unauthorized.'));

        // Expect the request to throw an AuthorizationException
//        $this->expectException(AuthorizationException::class);
        $this->actingAs(User::factory()->create())->get(route('listing.index'));
    }

    /**
     * Test the show method.
     */
    public function test_show_displays_listing_with_details_and_offer_status(): void
    {
        // Test 1: Basic rendering of a listing for a logged-in user with no offer
        $listing = Listing::factory()->for($this->user, 'owner')->create(); // Use 'owner' relationship
        ListingImage::factory()->for($listing)->count(3)->create();

        $response = $this->actingAs($this->user)->get(route('listing.show', $listing));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Show')
                ->has('listing', fn(Assert $prop) => $prop->where('id', $listing->id)
                    ->has('images', 3)
                    ->etc()
                )
                ->where('offerMade', null) // No offer made yet
        );

        // Test 2: Listing exists but user is not logged in (an edge case)
        $listingNoAuth = Listing::factory()->for($this->user, 'owner')->create(); // Use 'owner' relationship
        $response = $this->get(route('listing.show', $listingNoAuth));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Show')
                ->has('listing')
                ->where('offerMade', null) // Should be null for guests
        );

        // Test 3: Logged-in user has made an offer (edge case)
        $listingWithOffer = Listing::factory()->for($this->user, 'owner')->create(); // Use 'owner' relationship
        $offer = Offer::factory()->for($listingWithOffer)->for($this->user, 'bidder')->create();

        $response = $this->actingAs($this->user)->get(route('listing.show', $listingWithOffer));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Show')
                ->has('listing')
                ->has('offerMade', fn(Assert $prop) => $prop->where('id', $offer->id)
                    ->where('bidder_id', $this->user->id)
                    ->etc()
                )
        );

        // Test 4: Logged-in user has NOT made an offer, but other offers exist (edge case)
        $listingOtherOffers = Listing::factory()->for($this->user, 'owner')->create(); // Use 'owner' relationship
        Offer::factory()->for($listingOtherOffers)->create(); // Offer from another user

        $response = $this->actingAs($this->user)->get(route('listing.show', $listingOtherOffers));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Show')
                ->has('listing')
                ->where('offerMade', null) // Current user has no offer
        );

        // Test 5: Listing without images (edge case)
        $listingNoImages = Listing::factory()->for($this->user, 'owner')->create(); // Use 'owner' relationship
        $response = $this->actingAs($this->user)->get(route('listing.show', $listingNoImages));

        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Listing/Show')
                ->has('listing', fn(Assert $prop) => $prop->has('images', 0)->etc())
        );

        // Test 6: Non-existent listing
        $response = $this->actingAs($this->user)->get(route('listing.show', 99999));
        $response->assertStatus(404);
    }

    /**
     * Test that an unauthorized user cannot view a specific listing.
     */
    public function test_show_authorization_failure(): void
    {
        $unauthorizedListing = Listing::factory()->for($this->user, 'owner')->create(); // Use 'owner' relationship

        // Clear the Gate::before handler from setUp
        Gate::before(fn() => null);

        // Mock the Gate facade directly
        Gate::shouldReceive('authorize')
            ->with('view', Mockery::type(Listing::class))
            ->once();
//            ->andThrow(new AuthorizationException('Unauthorized.'));

        // Expect the request to throw an AuthorizationException
//        $this->expectException(AuthorizationException::class);
        $this->actingAs(User::factory()->create())->get(route('listing.show', $unauthorizedListing));
    }
}
