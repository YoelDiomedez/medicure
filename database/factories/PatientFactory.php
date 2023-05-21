<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['M', 'F']);
        $name   = ($gender == 'M') ? fake()->firstNameMale() : fake()->firstNameFemale() ;

        $doc_type = fake()->randomElement(['DNI', 'RUC', 'P. NAC.', 'CARNET EXT.', 'PASAPORTE', 'OTRO']);
        $doc_numb = null;

        switch ($doc_type) {
            case 'DNI':
                $doc_numb = fake()->dni();
                break;

            case 'RUC':
                $doc_numb = fake()->ruc(fake()->boolean());
                break;

            default:
                $doc_numb = fake()->unique()->ean8();
                break;
        }

        return [
            'surnames'       => fake()->lastName(),
            'names'          => $name,
            'birthdate'      => fake()->date(),
            'gender'         => $gender,
            'marital_status' => fake()->randomElement(['S', 'C', 'V', 'D']),
            'document_type'  => $doc_type,
            'document_numb'  => $doc_numb,
            'allergies'      => fake()->randomElement([null, fake()->sentence()]),
            'vaccines'       => fake()->randomElement([null, 1, 0]),
            'cellphone_num'  => fake()->randomElement([null, fake()->PhoneNumber()]),
            'address'        => fake()->randomElement([null, fake()->streetAddress()]),
            'email'          => fake()->unique()->safeEmail(),
            'profession'     => fake()->randomElement([null, fake()->jobTitle()]),
            'relative'       => fake()->randomElement([null, fake()->name()])
        ];
    }
}
