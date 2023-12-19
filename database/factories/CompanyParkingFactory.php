<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Geofence;
use App\Models\CompanyParking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyParking>
 */
class CompanyParkingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyParking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $companyKeys = Company::all()->modelKeys();
        $geofenceKeys = Geofence::all()->modelKeys();

        return [
            'company_id' => fake()->randomElement($companyKeys),
            'parking_name' => fake()->name,
            'parking_address' => fake()->address,
            'geofence_id' => fake()->randomElement($geofenceKeys),
            'is_active' => fake()->boolean(80) // 80% chance of being true (active)
        ];
    }
}
