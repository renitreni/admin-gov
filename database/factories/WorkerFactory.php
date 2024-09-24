<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'middle_name' => fake()->lastName(),
            'pin' => fake()->randomNumber(4),
            'passport_number' => fake()->swiftBicNumber(),
            'passport_expiry_date' => fake()->dateTimeBetween('now', '10 years')->format('Y-m-d'),
            'visa_type' => 'worker',
            'visa_number' => fake()->swiftBicNumber(),
            'visa_expiry_date' => fake()->dateTimeBetween('now', '4 years')->format('Y-m-d'),
            'national_id_number' => fake()->swiftBicNumber(),
            'residency_address' => fake()->address(),
            'emergency_contact_name' => fake()->name(), 
            'emergency_contact_phone' => fake()->phoneNumber(),
            'emergency_contact_relationship' => 'relative',
        ];
    }
}
