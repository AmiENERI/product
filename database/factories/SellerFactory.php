<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'address' => fake()->streetAddress(),
            'zip_code' => fake()->postcode(),
            'town' => fake()->city(),
            'city' => fake()->stateAbbr(),
            'state' => fake()->state(),
            'telephone' => fake()->e164PhoneNumber(),
            'email' => fake()->email(),
            'website' => fake()->url()
        ];
    }
}
