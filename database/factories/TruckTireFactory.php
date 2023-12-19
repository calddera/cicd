<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TruckTire>
 */
class TruckTireFactory extends Factory
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
            'buy_date' => fake()->date(),
            'buy_price' => fake()->randomFloat(2),
            'serial_number' => fake()->text(8),
            'is_active' => fake()->numberBetween(0, 1)
        ];
    }
}
