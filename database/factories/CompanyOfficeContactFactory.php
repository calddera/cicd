<?php

namespace Database\Factories;

use App\Models\CompanyOffice;
use App\Models\CompanyOfficeContact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyOfficeContact>
 */
class CompanyOfficeContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyOfficeContact::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $companyOfficeKeys = CompanyOffice::all()->modelKeys();

        return [
            'company_office_id' => fake()->randomElement($companyOfficeKeys),
            'contact_name' => fake()->name,
            'contact_address' => fake()->address,
            'contact_email' => fake()->email,
            'contact_phone_number' => fake()->numerify('##########')
        ];
    }
}
