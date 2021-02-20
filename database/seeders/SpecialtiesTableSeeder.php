<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
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
                'name'           => 'الصيدليات',
            ],
            [
                'id'             => 2,
                'name'           => 'الجراحة العامة',
            ],
            [
                'id'             => 3,
                'name'           => 'النساء والتوليد',
            ],
            [
                'id'             => 4,
                'name'           => 'الأطفال',
            ],
            [
                'id'             => 5,
                'name'           => 'العظام والكسور',
            ],
            [
                'id'             => 6,
                'name'           => 'الجملة العصبية',
            ],
            [
                'id'             => 7,
                'name'           => 'الأسنان',
            ],
            [
                'id'             => 8,
                'name'           => 'الأنف والأذن',
            ],
            [
                'id'             => 9,
                'name'           => 'العيون',
            ],
            [
                'id'             => 10,
                'name'           => 'الباطنية',
            ],
            [
                'id'             => 11,
                'name'           => 'قلب وأوعية دموية',
            ],
            [
                'id'             => 12,
                'name'           => 'تخسيس وتغذية',
            ],
            [
                'id'             => 13,
                'name'           => 'جلد',
            ],
            [
                'id'             => 14,
                'name'           => 'جراحة تجميل',
            ],
            [
                'id'             => 15,
                'name'           => 'مخ وأعصاب',
            ],
        ];
        Specialty::insert($days);
    }
}
