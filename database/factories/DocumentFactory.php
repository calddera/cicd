<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $documentTypesKeys = \App\Models\DocumentType::all()->modelKeys();

        return [
            'document_name' => fake()->unique()->text(20),
            'document_type_id' => fake()->randomElement($documentTypesKeys),
            'is_mandatory' => fake()->numberBetween(0, 1)
        ];
    }
}
