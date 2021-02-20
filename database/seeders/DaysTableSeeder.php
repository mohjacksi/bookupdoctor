<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Day;
class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            [
                'id'             => 1,
                'name'           => 'سبت',
            ],
            [
                'id'             => 2,
                'name'           => 'أحد',
            ],
            [
                'id'             => 3,
                'name'           => 'إثنين',
            ],
            [
                'id'             => 4,
                'name'           => 'ثلاثاء',
            ],
            [
                'id'             => 5,
                'name'           => 'أربعاء',
            ],
            [
                'id'             => 6,
                'name'           => 'خميس',
            ],
            [
                'id'             => 7,
                'name'           => 'جمعة',
            ],
        ];
        Day::insert($days);
    }
}
