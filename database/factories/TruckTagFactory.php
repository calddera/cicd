<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TruckTag>
 */
class TruckTagFactory extends Factory
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
            'tag_name' => fake()->text(20),
            'valid_until' => fake()->date()
        ];
    }
}
