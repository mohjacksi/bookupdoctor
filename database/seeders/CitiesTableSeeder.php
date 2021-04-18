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
            ['id' => 2, 'name' => 'كركوك',],
            ['id' => 3, 'name' => 'الأنبار',],
            ['id' => 4, 'name' => 'البصرة - قريباً',],
            ['id' => 5, 'name' => 'نينوى - قريباً',],
            ['id' => 6, 'name' => 'أربيل - قريباً',],
            ['id' => 7, 'name' => 'حلبجة - قريباً',],
            ['id' => 8, 'name' => 'النجف - قريباً',],
            ['id' => 9, 'name' => 'ذي قار - قريباً',],
            ['id' => 10, 'name' => 'ديالى - قريباً',],
            ['id' => 11, 'name' => 'المثنى - قريباً',],
            ['id' => 12, 'name' => 'القادسية - قريباً',],
            ['id' => 13, 'name' => 'ميسان - قريباً',],
            ['id' => 14, 'name' => 'واسط - قريباً',],
            ['id' => 15, 'name' => 'صلاح الدين - قريباً',],
            ['id' => 16, 'name' => 'دهوك - قريباً',],
            ['id' => 17, 'name' => 'السليمانية - قريباً',],
            ['id' => 18, 'name' => 'بابل - قريباً',],
            ['id' => 19, 'name' => 'كربلاء - قريباً',],
        ];
        City::insert($cities);
    }
}
