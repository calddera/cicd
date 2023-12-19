<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trailer>
 */
class TrailerFactory extends Factory
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
        $trailerModelsKeys = \App\Models\TrailerModel::all()->modelKeys();
        $trailerTypesKeys = \App\Models\TrailerType::all()->modelKeys();

        return [
            'unit_number' => fake()->unique()->lexify('?????'),
            'vin_number' => fake()->unique()->lexify('?????????????????'),
            'vehicle_status_id' => fake()->randomElement($vehicleStatusesKeys),
            'trailer_type_id' => fake()->randomElement($trailerTypesKeys),
            'is_active' => fake()->numberBetween(0, 1),
            'trailer_model_id' => fake()->randomElement($trailerModelsKeys),
            'trademark' => fake()->text(20),
            'IMAI' => fake()->unique()->text(20),
            'created_by' => fake()->randomElement($userKeys),
            'updated_by' => fake()->randomElement($userKeys)
        ];
    }
    
}
