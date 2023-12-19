<?php

namespace Database\Factories;

use App\Models\CustomerLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerLocationContact>
 */
class CustomerLocationContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $customerLocationKeys = CustomerLocation::all()->modelKeys();

        return [
            'customer_location_id' => fake()->randomElement($customerLocationKeys),
            'contact_name' => fake()->name,
            'contact_email' => fake()->unique()->safeEmail,
            'contact_phone_number' => fake()->numerify('##########'),
            'is_active' => fake()->boolean(80) // 80% chance of being true (active)
        ];
    }
}
