<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create(); // Initialize Faker

        $numberOfRecords = 10; // Adjust the number as needed

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $specialization = Specialization::inRandomOrder()->first();

            Teacher::create([
                'Email' => $faker->unique()->safeEmail,
                'Password' => bcrypt('password'),
                'Gender' => $faker->randomElement(['male', 'female']), 
                'Name' => $faker->name,
                'Specialization_id' => $specialization->id,
                'Joining_Date' => $faker->date(),
                'Address' => $faker->address,
            ]);
        }
    }
}