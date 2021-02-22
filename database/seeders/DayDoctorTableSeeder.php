<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DayDoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $days_morning = [
            1 => "1",
            2 => "3",
            3 => "5",
            4 => "4",
            5 => "5",
            6 => "4",
        ];

        $days_evening = [
            1 => "1",
            2 => "3",
            3 => "5",
            4 => "4",
            5 => "5",
            6 => "4",
        ];

        for ($i = 1; $i <= 100; $i++) {
            Doctor::findOrFail($i)->days()->sync($this->daysMapper($days_morning,$days_evening));
        }
    }
    private function daysMapper($days_morning, $days_evening)
    {
        //dd($days_morning);
        return collect($days_morning)->map(function ($i, $j) use ($days_evening) {
            return ['morning' => $i, 'evening' => $days_evening[$j]];
        });
    }
}
