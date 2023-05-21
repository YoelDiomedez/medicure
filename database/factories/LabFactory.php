<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lab>
 */
class LabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => \App\Models\Patient::factory(),
            'service_id' => \App\Models\Service::factory(),
            'user_id'    => \App\Models\User::factory(),
            'amount'     => fake()->randomFloat(2, 500, 10000),
            'report'     => fake()->paragraphs(fake()->numberBetween(5, 10), true),
        ];
    }
}
