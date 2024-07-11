<?php

namespace Database\Factories;

use App\Models\Producer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        
     public function definition(): array
    {
        $imageId = fake()->numberBetween(1, 1000);
        $photoUrl = "https://picsum.photos/id/{$imageId}/400/600";
        
        return [
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'producer_id' => function () {
                return Producer::inRandomOrder()->first()->id; // Ottiene un ID casuale di un regista esistente
            },
                'color' => fake()->safeColorName(),
                'code' => fake()->postcode(),
                'price' => fake()->randomNumber(2),
                'photo' => $photoUrl
            ];
    }
}


