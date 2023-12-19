<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

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
            'department_name' => fake()->jobTitle,
            'is_active' => fake()->boolean(80) // 80% chance of being true (active)
        ];
    }
}
