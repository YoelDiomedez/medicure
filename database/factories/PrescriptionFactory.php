<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attention_id' => \App\Models\Attention::factory(),
            'drug'         => fake()->word(),
            'amount'       => fake()->randomFloat(2, 20, 30),
            'shape'        => fake()->word(),
            'dose'         => fake()->randomElement([null, fake()->randomFloat(2, 10, 20)]),
            'route'        => fake()->word(),
            'frequency'    => fake()->word(),
            'term'         => fake()->word(),
            'note'         => fake()->randomElement([null, fake()->sentence()]),
        ];
    }
}
