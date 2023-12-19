<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CostCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CostCenter>
 */
class CostCenterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CostCenter::class;

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
            'cost_center_code' => fake()->swiftBicNumber
        ];
    }
}
