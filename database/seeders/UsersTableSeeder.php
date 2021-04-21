<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'moh.jacksi@gmail.com',
                'password'       => bcrypt('mohammed1995'),
                'remember_token' => null,
                'phone_number'   => '',
            ],
            [
                'id'             => 2,
                'name'           => 'Mohammed Fadhel',
                'email'          => 'hguvhr199785@gmail.com',
                'password'       => bcrypt('hguvhrhguvhr'),
                'remember_token' => null,
                'phone_number'   => '',
            ],

        ];

        User::insert($users);
    }
}
