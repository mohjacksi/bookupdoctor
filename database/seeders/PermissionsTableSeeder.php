<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'option_access',
            ],
            [
                'id'    => 18,
                'title' => 'day_create',
            ],
            [
                'id'    => 19,
                'title' => 'day_edit',
            ],
            [
                'id'    => 20,
                'title' => 'day_show',
            ],
            [
                'id'    => 21,
                'title' => 'day_delete',
            ],
            [
                'id'    => 22,
                'title' => 'day_access',
            ],
            [
                'id'    => 23,
                'title' => 'specialty_create',
            ],
            [
                'id'    => 24,
                'title' => 'specialty_edit',
            ],
            [
                'id'    => 25,
                'title' => 'specialty_show',
            ],
            [
                'id'    => 26,
                'title' => 'specialty_delete',
            ],
            [
                'id'    => 27,
                'title' => 'specialty_access',
            ],
            [
                'id'    => 28,
                'title' => 'city_create',
            ],
            [
                'id'    => 29,
                'title' => 'city_edit',
            ],
            [
                'id'    => 30,
                'title' => 'city_show',
            ],
            [
                'id'    => 31,
                'title' => 'city_delete',
            ],
            [
                'id'    => 32,
                'title' => 'city_access',
            ],
            [
                'id'    => 33,
                'title' => 'setting_create',
            ],
            [
                'id'    => 34,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 35,
                'title' => 'setting_show',
            ],
            [
                'id'    => 36,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 37,
                'title' => 'setting_access',
            ],
            [
                'id'    => 38,
                'title' => 'client_access',
            ],
            [
                'id'    => 39,
                'title' => 'pharmacy_create',
            ],
            [
                'id'    => 40,
                'title' => 'pharmacy_edit',
            ],
            [
                'id'    => 41,
                'title' => 'pharmacy_show',
            ],
            [
                'id'    => 42,
                'title' => 'pharmacy_delete',
            ],
            [
                'id'    => 43,
                'title' => 'pharmacy_access',
            ],
            [
                'id'    => 44,
                'title' => 'doctor_create',
            ],
            [
                'id'    => 45,
                'title' => 'doctor_edit',
            ],
            [
                'id'    => 46,
                'title' => 'doctor_show',
            ],
            [
                'id'    => 47,
                'title' => 'doctor_delete',
            ],
            [
                'id'    => 48,
                'title' => 'doctor_access',
            ],
            [
                'id'    => 49,
                'title' => 'appointments_status_create',
            ],
            [
                'id'    => 50,
                'title' => 'appointments_status_edit',
            ],
            [
                'id'    => 51,
                'title' => 'appointments_status_show',
            ],
            [
                'id'    => 52,
                'title' => 'appointments_status_delete',
            ],
            [
                'id'    => 53,
                'title' => 'appointments_status_access',
            ],
            [
                'id'    => 54,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 55,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 56,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 57,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 58,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 59,
                'title' => 'portfolio_create',
            ],
            [
                'id'    => 60,
                'title' => 'portfolio_edit',
            ],
            [
                'id'    => 61,
                'title' => 'portfolio_show',
            ],
            [
                'id'    => 62,
                'title' => 'portfolio_delete',
            ],
            [
                'id'    => 63,
                'title' => 'portfolio_access',
            ],
            [
                'id'    => 64,
                'title' => 'payment_create',
            ],
            [
                'id'    => 65,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 66,
                'title' => 'payment_show',
            ],
            [
                'id'    => 67,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 68,
                'title' => 'payment_access',
            ],
            [
                'id'    => 69,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 70,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 71,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
