<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSpecialtyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num_of_specialites = 2;
        for ($i = 1; $i <= 13778; $i++) {
            Doctor::findOrFail($i)->specialties()->sync($i % $num_of_specialites + 1);
            Doctor::findOrFail($i)->specialties()->sync(($i+2) % $num_of_specialites + 1);
            Doctor::findOrFail($i)->specialties()->sync(($i+8) % $num_of_specialites + 1);
        }
    }
}
