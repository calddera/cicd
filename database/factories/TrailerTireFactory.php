<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrailerTire>
 */
class TrailerTireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $trailerKeys = \App\Models\Trailer::all()->modelKeys();

        return [
            'trailer_id' => fake()->randomElement($trailerKeys),
            'buy_date' => fake()->date(),
            'buy_price' => fake()->randomFloat(2),
            'serial_number' => fake()->text(20),
            'is_active' => fake()->numberBetween(0, 1)
        ];
    }
}
