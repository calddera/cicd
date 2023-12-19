<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $registers = ['Sole proprietors', 'Partnerships', 'Corporation', 'Non-Profit', 'Private', 'Limited liability'];

        return [
            'company_name' => fake()->company,
            'employer_register' => fake()->randomElement($registers),
            'RFC' => fake()->unique()->regexify('[A-Z]{4}[0-9]{6}[A-Z0-9]{3}'),
            'employer_representative' => fake()->name,
            'legal_representative' => fake()->name,
            'tax_residence' => fake()->address
        ];
    }
}
