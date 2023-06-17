<?php

namespace Database\Factories;

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
        return [
            'name' => fake()->sentence($nbWords = 6, $variableNbWords = true),
            'description' => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            'image' => fake()->imageUrl($width = 640, $height = 480),
            'price' => fake()->numberBetween(100,1000)
        ];
    }
}
