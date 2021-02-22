<?php

namespace Database\Seeders;

use App\Models\AppointmentsStatus;
use Illuminate\Database\Seeder;

class AppointmentsStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id' => 1,
                'name' => 'مستلم',
                'color' => '#ff00ff',
            ],
            [
                'id' => 2,
                'name' => 'تم الحجز',
                'color' => '#0000ff',
            ],
            [
                'id' => 3,
                'name' => 'تم الإخبار',
                'color' => '#ff0000',
            ],
            [
                'id' => 4,
                'name' => 'تم الإلغاء',
                'color' => '#0ff000',
            ],
        ];
        AppointmentsStatus::insert($statuses);
    }
}
