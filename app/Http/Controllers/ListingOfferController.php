<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Models\User;
use App\Notifications\OfferMade;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ListingOfferController extends Controller
{
    use AuthorizesRequests;

    /**
     * @return RedirectResponse
     */
    public function store(Listing $listing, Request $request)
    {
        $this->authorize('view', $listing);

        Gate::authorize('view', $listing);

        $validated = $request->validate([
            'amount' => 'required|integer|min:1|max:20000000',
        ]);

        $offer = new Offer($validated);
        $offer->bidder()->associate($request->user());
        /** @var Offer $offer */
        $offer = $listing->offers()->save($offer);

        /** @var User $owner */
        $owner = $listing->owner;
        $owner->notify(
            new OfferMade($offer)
        );

        return redirect()->back()->with(
            'success',
            'Offer was made!'
        );
    }
}
