<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MyParent>
 */
class MyParentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Email' => $this->faker->unique()->safeEmail,
            'Password' => bcrypt('password'),
            'Name_Father' => $this->faker->name,
            'National_ID_Father' => $this->faker->regexify('[A-Z0-9]{10}'),
            'Passport_ID_Father' => $this->faker->regexify('[A-Z0-9]{9}'),
            'Phone_Father' => $this->faker->phoneNumber,
            'Job_Father' => $this->faker->jobTitle,
            'Address_Father' => $this->faker->address,
            'Name_Mother' => $this->faker->name,
            'National_ID_Mother' => $this->faker->regexify('[A-Z0-9]{10}'),
            'Passport_ID_Mother' => $this->faker->regexify('[A-Z0-9]{9}'),
            'Phone_Mother' => $this->faker->phoneNumber,
            'Job_Mother' => $this->faker->jobTitle,
            'Address_Mother' => $this->faker->address,
        ];
        
    }
}