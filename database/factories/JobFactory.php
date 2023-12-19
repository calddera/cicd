<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $departmentKeys = Department::all()->modelKeys();

        return [
            'department_id' => fake()->randomElement($departmentKeys),
            'job_code' => fake()->unique()->numerify('#####'),
            'job_name' => fake()->unique()->jobTitle,
            'is_active' => fake()->boolean(80) // 80% chance of being true (active)
        ];
    }
}
