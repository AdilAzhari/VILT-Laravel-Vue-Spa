<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Gate;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        $listing = $offer->listing;
        // $this->authorize('update', $listing);
        Gate::authorize('update', $listing);

        // Accept selected offer
        $offer->update(['accepted_at' => now()]);

        $listing->sold_at = now();
        $listing->save();

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
