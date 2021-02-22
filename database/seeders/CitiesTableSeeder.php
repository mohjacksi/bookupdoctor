<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['id' => 1, 'name' => 'بغداد',],
            ['id' => 2, 'name' => 'البصرة',],
            ['id' => 3, 'name' => 'نينوى',],
            ['id' => 4, 'name' => 'أربيل',],
            ['id' => 5, 'name' => 'حلبجة',],
            ['id' => 6, 'name' => 'النجف',],
            ['id' => 7, 'name' => 'ذي قار',],
            ['id' => 8, 'name' => 'كركوك',],
            ['id' => 9, 'name' => 'الأنبار',],
            ['id' => 10, 'name' => 'ديالى',],
            ['id' => 11, 'name' => 'المثنى',],
            ['id' => 12, 'name' => 'القادسية',],
            ['id' => 13, 'name' => 'ميسان',],
            ['id' => 14, 'name' => 'واسط',],
            ['id' => 15, 'name' => 'صلاح الدين',],
            ['id' => 16, 'name' => 'دهوك',],
            ['id' => 17, 'name' => 'السليمانية',],
            ['id' => 18, 'name' => 'بابل',],
            ['id' => 19, 'name' => 'كربلاء',],
        ];
        City::insert($cities);
    }
}
