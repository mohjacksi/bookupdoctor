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
        for ($i = 1; $i <= 100; $i++) {
            Doctor::findOrFail($i)->specialties()->sync($i % 14 + 1);
            Doctor::findOrFail($i)->specialties()->sync(($i+2) % 14 + 1);
            Doctor::findOrFail($i)->specialties()->sync(($i+8) % 14 + 1);
        }
    }
}
