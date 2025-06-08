<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Support\Facades\Gate;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        /** @var Listing $listing */
        $listing = $offer->listing;

        Gate::authorize('update', $listing);

        // Accept selected offer
        $offer->update(['accepted_at' => now()]);

        // Update listing
        $listing->update(['sold_at' => now()]);

        // Reject all other offers
        $listing->offers()->except($offer)
            ->update(['rejected_at' => now()]);

        return redirect()->back()
            ->with(
                'success',
                sprintf('Offer #%s accepted, other offers rejected', $offer->id)
            );
    }
}
