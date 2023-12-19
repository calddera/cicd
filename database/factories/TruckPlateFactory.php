<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TruckPlate>
 */
class TruckPlateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $truckKeys = \App\Models\Truck::all()->modelKeys();

        return [
            'truck_id' => fake()->randomElement($truckKeys),
            'plate_country' => fake()->lexify('???'),
            'plate_code' => fake()->unique()->text(8),
            'plate_expires_at' => fake()->date(),
            'plate_photo' => fake()->text(50),
            'is_active' => fake()->numberBetween(0, 1)
        ];
    }
}
