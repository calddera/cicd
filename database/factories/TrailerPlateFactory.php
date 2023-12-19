<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrailerPlate>
 */
class TrailerPlateFactory extends Factory
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
            'plate_country' => fake()->lexify('???'),
            'plate_code' => fake()->unique()->text(8),
            'plate_expires_at' => fake()->date(),
            'plate_photo' => fake()->text(50),
            'is_active' => fake()->numberBetween(0, 1)
        ];
    }
}
