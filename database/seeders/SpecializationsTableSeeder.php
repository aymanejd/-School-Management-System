<?php

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = ['Arabic','French','Sciences','English','Mathematics','Physics','Philosophy'];
        foreach ($specializations as $S) {
            Specialization::create(['Name' => $S]);
        }
    }
}