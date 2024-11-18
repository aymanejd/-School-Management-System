<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Nationalitie;
use App\Models\Phase;
use App\Models\Grade;
use App\Models\Section;
use App\Models\My_Parent;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create(); // Initialize Faker

        $numberOfRecords = 10; // Adjust the number as needed

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $nationality = Nationalitie::inRandomOrder()->first();
            $phase = Phase::inRandomOrder()->first();
            $grade = Grade::where('phase_id', $phase->id)->inRandomOrder()->first();

            // If $grade is null, retrieve a random grade from any phase
            if (!$grade) {
                $grade = Grade::inRandomOrder()->first();
            }

            // Retrieve a random section associated with the grade
            $section = Section::where('grade_id', $grade->id)->inRandomOrder()->first();
            // If $section is null, retrieve a random section from any grade
            if (!$section) {
                $section = Section::inRandomOrder()->first();
            }

            $parent = My_Parent::inRandomOrder()->first();

            Student::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'Gender' => $faker->randomElement(['male', 'female']),
                'nationalitie_id' => $nationality->id,
                'Date_Birth' => $faker->date(),
                'phase_id' => $phase->id,
                'grade_id' => $grade->id,
                'section_id' => $section->id,
                'parent_id' => $parent->id,
                'academic_year' => '2023-2024', // Example academic year
            ]);
        }
    }
}