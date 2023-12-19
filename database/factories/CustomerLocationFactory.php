<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\LocationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerLocation>
 */
class CustomerLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $customerKeys = Customer::all()->modelKeys();
        $locationTypeKeys = LocationType::all()->modelKeys();

        return [
            'customer_id' => fake()->randomElement($customerKeys),
            'customer_location_name' => fake()->company,
            'location_type_id' => fake()->randomElement($locationTypeKeys),
            'location_country' => fake()->countryCode,
            'location_zipcode' => fake()->numerify('######'),
            'location_state' => fake()->state,
            'location_city' => fake()->city,
            'location_address' => fake()->streetAddress,
            'location_lat' => fake()->latitude,
            'location_lng' => fake()->longitude,
            'is_active' => fake()->boolean(80) // 80% chance of being true (active)
        ];
    }
}
