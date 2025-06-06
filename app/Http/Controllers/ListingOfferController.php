<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class ListingOfferController extends Controller
{
    use AuthorizesRequests;
    /**
     * @param Listing $listing
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Listing $listing, Request $request)
    {
         $this->authorize('view', $listing);

        Gate::authorize('view', $listing);

        $offer = $listing->offers()->save(
            Offer::query()->make(
                $request->validate([
                    'amount' => 'required|integer|min:1|max:20000000',
                ])
            )->bidder()->associate($request->user())
        );
        $listing->owner->notify(
            new OfferMade($offer)
        );

        return redirect()->back()->with(
            'success',
            'Offer was made!'
        );
    }
}
