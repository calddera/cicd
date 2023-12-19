<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrailerDocument>
 */
class TrailerDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $trailerKeys = \App\Models\Trailer::all()->modelKeys();
        $documentKeys = \App\Models\Document::all()->modelKeys();
        $userKeys = \App\Models\User::all()->modelKeys();


        return [
            'trailer_id' => fake()->randomElement($trailerKeys),
            'document_id' => fake()->randomElement($documentKeys),
            'file_name' => fake()->text(20),
            'file_path' => fake()->text(20),
            'valid_until' => fake()->date(),
            'is_active' => fake()->numberBetween(0, 1),
            'created_by' => fake()->randomElement($userKeys),
            'updated_by' => fake()->randomElement($userKeys)
        ];
    }
}
