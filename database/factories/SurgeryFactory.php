<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Surgery>
 */
class SurgeryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id'         => \App\Models\Patient::factory(),
            'pre_diagnosis_id'   => \App\Models\Diagnosis::factory(),
            'post_diagnosis_id'  => \App\Models\Diagnosis::factory(),
            'date'               => fake()->date(),
            'start_time'         => fake()->time(),
            'end_time'           => fake()->time(),
            'bed_num'            => strval(fake()->randomNumber(3, false)),
            'anesthesia_type'    => fake()->randomElement(['Local', 'General', 'Regional']),
            'procedure_findings' => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'oxygen_use'         => fake()->randomFloat(2, 100, 999),
            'equipment'          => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'supplies'           => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'observations'       => fake()->paragraphs(fake()->numberBetween(2, 10), true),
            'amount'             => fake()->randomFloat(2, 1000, 10000),
        ];
    }
}
