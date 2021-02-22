<?php

return [
    'userManagement'     => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission'         => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'لقب',
            'title_helper'      => ' ',
            'created_at'        => 'انشئ في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التحديث في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'               => [
        'title'          => 'أدوار',
        'title_singular' => 'دور',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'أذونات',
            'permissions_helper' => ' ',
            'created_at'         => 'انشئ في',
            'created_at_helper'  => ' ',
            'updated_at'         => 'تم التحديث في',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'تم الحذف في',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'               => [
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'اسم',
            'name_helper'              => ' ',
            'email'                    => 'بريد الالكتروني',
            'email_helper'             => ' ',
            'email_verified_at'        => 'تم التحقق من البريد الإلكتروني في',
            'email_verified_at_helper' => ' ',
            'password'                 => 'كلمة المرور',
            'password_helper'          => ' ',
            'roles'                    => 'الأدوار',
            'roles_helper'             => ' ',
            'remember_token'           => 'تذكر الرمز',
            'remember_token_helper'    => ' ',
            'created_at'               => 'انشئ في',
            'created_at_helper'        => ' ',
            'updated_at'               => 'تم التحديث في',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'تم الحذف في',
            'deleted_at_helper'        => ' ',
            'phone_number'             => 'رقم التليفون',
            'phone_number_helper'      => ' ',
        ],
    ],
    'option'             => [
        'title'          => 'الإعدادات',
        'title_singular' => 'إعداد',
    ],
    'day'                => [
        'title'          => 'أيام',
        'title_singular' => 'يوم',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'اسم',
            'name_helper'       => ' ',
            'created_at'        => 'انشئ في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التحديث في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'specialty'          => [
        'title'          => 'التخصصات',
        'title_singular' => 'تخصص',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'اسم',
            'name_helper'       => ' ',
            'icon'              => 'أيقونة',
            'icon_helper'       => ' ',
            'created_at'        => 'انشئ في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التحديث في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'city'               => [
        'title'          => 'مدن',
        'title_singular' => 'مدينة',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'اسم',
            'name_helper'       => ' ',
            'created_at'        => 'انشئ في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التحديث في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'setting'            => [
        'title'          => 'إعدادات',
        'title_singular' => 'إعداد',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'key'               => 'مفتاح',
            'key_helper'        => ' ',
            'value'             => 'قيمة',
            'value_helper'      => ' ',
            'created_at'        => 'انشئ في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التحديث في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'client'             => [
        'title'          => 'العملاء',
        'title_singular' => 'عميل',
    ],
    'pharmacy'           => [
        'title'          => 'صيدليات',
        'title_singular' => 'دفعة',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'اسم',
            'name_helper'            => ' ',
            'logo'                   => 'شعار',
            'logo_helper'            => ' ',
            'location'               => 'موقع',
            'location_helper'        => ' ',
            'city'                   => 'مدينة',
            'city_helper'            => ' ',
            'longitude'              => 'خط الطول',
            'longitude_helper'       => ' ',
            'latitude'               => 'خط العرض',
            'latitude_helper'        => ' ',
            'is_special'             => 'إنه خاصl',
            'is_special_helper'      => ' ',
            'is_active'              => 'نشط',
            'is_active_helper'       => ' ',
            'expiration_date'        => 'تاريخ إنتهاء الصلاحية',
            'expiration_date_helper' => 'سيتم زيادتها تلقائيًا بعد إضافة الدفعة',
            'created_at'             => 'انشئ في',
            'created_at_helper'      => ' ',
            'updated_at'             => 'تم التحديث في',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'تم الحذف في',
            'deleted_at_helper'      => ' ',
            'days'                   => 'Days',
            'days_helper'            => ' ',
            'phone_number'           => 'رقم التليفون',
            'phone_number_helper'    => ' ',
        ],
    ],
    'doctor'             => [
        'title'          => 'الأطباء',
        'title_singular' => 'طبيب',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'اسم',
            'name_helper'            => ' ',
            'location'               => 'موقع',
            'location_helper'        => ' ',
            'image'                  => 'صورة',
            'image_helper'           => ' ',
            'days'                   => 'أيام',
            'days_helper'            => ' ',
            'stars'                  => 'النجوم',
            'stars_helper'           => ' ',
            'is_special'             => 'إنه خاص؟',
            'is_special_helper'      => ' ',
            'is_active'              => 'نشط؟',
            'is_active_helper'       => ' ',
            'expiration_date'        => 'تاريخ إنتهاء الصلاحية',
            'expiration_date_helper' => ' ',
            'latitude'               => 'خط العرض',
            'latitude_helper'        => ' ',
            'longitude'              => 'خط الطول',
            'longitude_helper'       => ' ',
            'city'                   => 'مدينة',
            'city_helper'            => ' ',
            'created_at'             => 'انشئ في',
            'created_at_helper'      => ' ',
            'updated_at'             => 'تم التحديث في',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'تم الحذف في',
            'deleted_at_helper'      => ' ',
            'specialties'            => 'التخصصات',
            'specialties_helper'     => ' ',
            'about'                  => 'حول',
            'about_helper'           => ' ',
            'phone_number'           => 'رقم التليفون',
            'phone_number_helper'    => ' ',
        ],
    ],
    'appointmentsStatus' => [
        'title'          => 'حالة المواعيد',
        'title_singular' => 'حالة المواعيد',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'اسم',
            'name_helper'       => ' ',
            'color'             => 'اللون',
            'color_helper'      => ' ',
            'created_at'        => 'انشئ في',
            'created_at_helper' => ' ',
            'updated_at'        => 'تم التحديث في',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'appointment'        => [
        'title'          => 'حجوزات',
        'title_singular' => 'حجز',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'اسم',
            'name_helper'          => ' ',
            'phone_number'         => 'رقم التليفون',
            'phone_number_helper'  => ' ',
            'date'                 => 'تاريخ',
            'date_helper'          => ' ',
            'time'                 => 'وقت',
            'time_helper'          => ' ',
            'status'               => 'حالة',
            'status_helper'        => ' ',
            'reserved_date'        => 'التاريخ المحجوز',
            'reserved_date_helper' => 'التاريخ المحجوز من قبل موظفينا',
            'notes'                => 'ملاحظات',
            'notes_helper'         => ' ',
            'created_at'           => 'انشئ في',
            'created_at_helper'    => ' ',
            'updated_at'           => 'تم التحديث في',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'تم الحذف في',
            'deleted_at_helper'    => ' ',
            'voice'                => 'صوت',
            'voice_helper'         => ' ',
        ],
    ],
    'portfolio'          => [
        'title'          => 'الملف الشخصي',
        'title_singular' => 'ملف',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'لقب',
            'title_helper'       => ' ',
            'desecration'        => 'وصف',
            'desecration_helper' => ' ',
            'images'             => 'الصور',
            'images_helper'      => ' ',
            'doctor'             => 'طبيب',
            'doctor_helper'      => ' ',
            'created_at'         => 'انشئ في',
            'created_at_helper'  => ' ',
            'updated_at'         => 'تم التحديث في',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'تم الحذف في',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'payment'            => [
        'title'          => 'المدفوعات',
        'title_singular' => 'دفع',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'type'               => 'اكتب',
            'type_helper'        => ' ',
            'amount'             => 'كمية',
            'amount_helper'      => ' ',
            'month_added'        => 'وأضاف الشهر',
            'month_added_helper' => ' ',
            'notes'              => 'ملاحظات',
            'notes_helper'       => ' ',
            'created_at'         => 'انشئ في',
            'created_at_helper'  => ' ',
            'updated_at'         => 'تم التحديث في',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'تم الحذف في',
            'deleted_at_helper'  => ' ',
            'doctor'             => 'طبيب',
            'doctor_helper'      => ' ',
            'pharmacy'           => 'دفعة',
            'pharmacy_helper'    => ' ',
            'date'               => 'تاريخ',
            'date_helper'        => ' ',
        ],
    ],
    'auditLog'           => [
        'title'          => 'سجلات التدقيق',
        'title_singular' => 'سجل التدقيق',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'وصف',
            'description_helper'  => ' ',
            'subject_id'          => 'معرف الموضوع',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'نوع الموضوع',
            'subject_type_helper' => ' ',
            'user_id'             => 'معرف المستخدم',
            'user_id_helper'      => ' ',
            'properties'          => 'ملكيات',
            'properties_helper'   => ' ',
            'host'                => 'مضيف',
            'host_helper'         => ' ',
            'created_at'          => 'انشئ في',
            'created_at_helper'   => ' ',
            'updated_at'          => 'تم التحديث في',
            'updated_at_helper'   => ' ',
        ],
    ],
];
