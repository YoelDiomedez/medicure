<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Record>
 */
class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attention_id'             => \App\Models\Attention::factory(),
            'symptom'                  => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'history'                  => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'physiological_background' => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'pathological_background'  => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'physical_exam'            => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'auxiliary_exams'          => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'treatment'                => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'instruction'              => fake()->paragraphs(fake()->numberBetween(2, 10), true),
        ];
    }
}
