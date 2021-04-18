<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,


            DaysTableSeeder::class,
            SpecialtiesTableSeeder::class,
            CitiesTableSeeder::class,
            AppointmentsStatusesTableSeeder::class,
            SettingsTableSeeder::class,
            // PharmacyTableSeeder::class,
            // DoctorsTableSeeder::class,
            // DoctorSpecialtyTableSeeder::class,
            DayDoctorTableSeeder::class,
        ]);
    }
}
