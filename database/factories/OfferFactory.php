<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(100000, 500000),
            'listing_id' => Listing::factory(),
            'bidder_id' => User::factory(),
        ];
    }

    public function lowerOffer(): OfferFactory|Factory
    {
        return $this->state(function () {
            return [
                'amount' => $this->faker->numberBetween(50000, 99999),
            ];
        });
    }
}
