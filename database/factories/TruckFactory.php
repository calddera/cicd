<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Truck>
 */
class TruckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userKeys = \App\Models\User::all()->modelKeys();
        $vehicleStatusesKeys = \App\Models\VehicleStatus::all()->modelKeys();

        return [
            'unit_number' => fake()->unique()->lexify('?????'),
            'vin_number' => fake()->unique()->text(16),
            'vehicle_status_id' => fake()->randomElement($vehicleStatusesKeys),
            'is_active' => fake()->numberBetween(0, 1),
            'odometer' => fake()->randomFloat(2),
            'odometer_last_updated_at' => fake()->date(),
            'fuel_percent' => fake()->numberBetween(0, 100),
            'fuel_last_updated_at' => fake()->date(),
            'created_by' => fake()->randomElement($userKeys),
            'updated_by' => fake()->randomElement($userKeys)
        ];
    }
}
