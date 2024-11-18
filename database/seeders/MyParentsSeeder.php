<?php

namespace Database\Seeders;

use App\Models\My_Parent;
use App\Models\Religion;
use App\Models\Nationalitie;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class MyParentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create(); // Initialize Faker

        $numberOfRecords = 10; // Adjust the number as needed

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $religion = Religion::inRandomOrder()->first();
            $nationality = Nationalitie::inRandomOrder()->first();

            My_Parent::create([
                'Email' => $faker->unique()->safeEmail,
                'Password' => bcrypt('password'),
                'Name_Father' => $faker->name,
                'National_ID_Father' => $faker->regexify('[A-Z0-9]{10}'),
                'Passport_ID_Father' => $faker->regexify('[A-Z0-9]{9}'),
                'Phone_Father' => $faker->phoneNumber,
                'Job_Father' => $faker->jobTitle,
                'Nationality_Father_id' => $nationality->id,
                'Religion_Father_id' => $religion->id,
                'Address_Father' => $faker->address,
                'Name_Mother' => $faker->name,
                'National_ID_Mother' => $faker->regexify('[A-Z0-9]{10}'),
                'Passport_ID_Mother' => $faker->regexify('[A-Z0-9]{9}'),
                'Phone_Mother' => $faker->phoneNumber,
                'Job_Mother' => $faker->jobTitle,
                'Nationality_Mother_id' => $nationality->id,
                'Religion_Mother_id' => $religion->id,
                'Address_Mother' => $faker->address,
            ]);
        }
    }
}