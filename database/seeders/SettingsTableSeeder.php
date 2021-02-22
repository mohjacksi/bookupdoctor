<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'id' => 1,
                'key' => 'support_phone',
                'value' => '07502120570',
            ],
            [
                'id' => 2,
                'key' => 'support_phone2',
                'value' => '07502120570',
            ],
            [
                'id' => 3,
                'key' => 'support_phone3',
                'value' => '07502120570',
            ]
        ];
        Setting::insert($settings);
    }
}
