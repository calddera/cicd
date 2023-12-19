<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customerStatusKeys = CustomerStatus::all()->modelKeys();

        return [
            'customer_name' => fake()->company,
            'customer_tax_residence' => fake()->address,
            'RFC' => fake()->unique()->regexify('[A-Z]{4}[0-9]{6}[A-Z0-9]{3}'),
            'customer_status_id' => fake()->randomElement($customerStatusKeys),
            'is_active' => fake()->boolean(80) // 80% chance of being true (active)
        ];
    }
}
