<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyOffice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyOffice>
 */
class CompanyOfficeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyOffice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $companyKeys = Company::all()->modelKeys();

        return [
            'company_id' => fake()->randomElement($companyKeys),
            'office_name' => fake()->secondaryAddress,
            'office_address' => fake()->address,
            'office_country' => fake()->countryCode,
            'office_state' => fake()->state,
            'office_city' => fake()->city,
            'office_zip_code' => fake()->numerify('######'),
            'office_lat' => fake()->latitude,
            'office_lng' => fake()->longitude,
            'is_active' => fake()->boolean(80) // 80% chance of being true (active)
        ];
    }
}
