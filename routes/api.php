<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Days
    Route::apiResource('days', 'DaysApiController');

    // Specialties
    Route::post('specialties/media', 'SpecialtiesApiController@storeMedia')->name('specialties.storeMedia');
    Route::apiResource('specialties', 'SpecialtiesApiController');

    // Cites
    Route::apiResource('cites', 'CitesApiController');

    // Settings
    Route::apiResource('settings', 'SettingsApiController');

    // Pharmacies
    Route::post('pharmacies/media', 'PharmaciesApiController@storeMedia')->name('pharmacies.storeMedia');
    Route::apiResource('pharmacies', 'PharmaciesApiController');

    // Doctors
    Route::post('doctors/media', 'DoctorsApiController@storeMedia')->name('doctors.storeMedia');
    Route::apiResource('doctors', 'DoctorsApiController');

    // Appointments Statuses
    Route::apiResource('appointments-statuses', 'AppointmentsStatusApiController');

    // Appointments
    Route::post('appointments/media', 'AppointmentsApiController@storeMedia')->name('appointments.storeMedia');
    Route::apiResource('appointments', 'AppointmentsApiController');

    // Portfolios
    Route::post('portfolios/media', 'PortfoliosApiController@storeMedia')->name('portfolios.storeMedia');
    Route::apiResource('portfolios', 'PortfoliosApiController');

    // Payments
    Route::apiResource('payments', 'PaymentsApiController');
});