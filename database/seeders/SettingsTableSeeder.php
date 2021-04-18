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
                'value' => '0773-880-9900',
            ],
            [
                'id' => 2,
                'key' => 'support_phone2',
                'value' => '0780-328-8111',
            ],
            [
                'id' => 3,
                'key' => 'support_phone3',
                'value' => '0751-531-8063',
            ]
        ];
        Setting::insert($settings);
    }
}
