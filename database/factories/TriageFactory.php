<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Triage>
 */
class TriageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $height = fake()->numberBetween(150, 200);
        $weight = fake()->randomFloat(2, 50, 100);
        $bmi    = $weight / (($height / 100) * ($height / 100));
        return [
            'attention_id'      => \App\Models\Attention::factory(),
            'height'            => $height,
            'weight'            => $weight,
            'bmi'               => round($bmi, 2),
            'temperature'       => fake()->randomFloat(2, 36, 38),
            'heart_rate'        => strval(fake()->numberBetween(60, 100)),
            'respiratory_rate'  => strval(fake()->numberBetween(12, 16)),
            'blood_pressure'    => strval(fake()->numberBetween(100, 120)) . '/' . strval(fake()->numberBetween(50, 80)),
            'oxygen_saturation' => strval(fake()->numberBetween(90, 100)),
        ];
    }
}
