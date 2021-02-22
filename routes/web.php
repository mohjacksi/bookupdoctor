<?php

Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Days
    Route::delete('days/destroy', 'DaysController@massDestroy')->name('days.massDestroy');
    Route::resource('days', 'DaysController');

    // Specialties
    Route::delete('specialties/destroy', 'SpecialtiesController@massDestroy')->name('specialties.massDestroy');
    Route::post('specialties/media', 'SpecialtiesController@storeMedia')->name('specialties.storeMedia');
    Route::post('specialties/ckmedia', 'SpecialtiesController@storeCKEditorImages')->name('specialties.storeCKEditorImages');
    Route::resource('specialties', 'SpecialtiesController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CitiesController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingsController');

    // Pharmacies
    Route::delete('pharmacies/destroy', 'PharmaciesController@massDestroy')->name('pharmacies.massDestroy');
    Route::post('pharmacies/media', 'PharmaciesController@storeMedia')->name('pharmacies.storeMedia');
    Route::post('pharmacies/ckmedia', 'PharmaciesController@storeCKEditorImages')->name('pharmacies.storeCKEditorImages');
    Route::resource('pharmacies', 'PharmaciesController');

    // Doctors
    Route::delete('doctors/destroy', 'DoctorsController@massDestroy')->name('doctors.massDestroy');
    Route::post('doctors/media', 'DoctorsController@storeMedia')->name('doctors.storeMedia');
    Route::post('doctors/ckmedia', 'DoctorsController@storeCKEditorImages')->name('doctors.storeCKEditorImages');
    Route::resource('doctors', 'DoctorsController');

    // Appointments Statuses
    Route::delete('appointments-statuses/destroy', 'AppointmentsStatusController@massDestroy')->name('appointments-statuses.massDestroy');
    Route::resource('appointments-statuses', 'AppointmentsStatusController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::post('appointments/media', 'AppointmentsController@storeMedia')->name('appointments.storeMedia');
    Route::post('appointments/ckmedia', 'AppointmentsController@storeCKEditorImages')->name('appointments.storeCKEditorImages');
    Route::resource('appointments', 'AppointmentsController');

    // Portfolios
    Route::delete('portfolios/destroy', 'PortfoliosController@massDestroy')->name('portfolios.massDestroy');
    Route::post('portfolios/media', 'PortfoliosController@storeMedia')->name('portfolios.storeMedia');
    Route::post('portfolios/ckmedia', 'PortfoliosController@storeCKEditorImages')->name('portfolios.storeCKEditorImages');
    Route::resource('portfolios', 'PortfoliosController');

    // Payments
    Route::delete('payments/destroy', 'PaymentsController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentsController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Days
    Route::delete('days/destroy', 'DaysController@massDestroy')->name('days.massDestroy');
    Route::resource('days', 'DaysController');

    // Specialties
    Route::delete('specialties/destroy', 'SpecialtiesController@massDestroy')->name('specialties.massDestroy');
    Route::post('specialties/media', 'SpecialtiesController@storeMedia')->name('specialties.storeMedia');
    Route::post('specialties/ckmedia', 'SpecialtiesController@storeCKEditorImages')->name('specialties.storeCKEditorImages');
    Route::resource('specialties', 'SpecialtiesController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CitiesController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingsController');

    // Pharmacies
    Route::delete('pharmacies/destroy', 'PharmaciesController@massDestroy')->name('pharmacies.massDestroy');
    Route::post('pharmacies/media', 'PharmaciesController@storeMedia')->name('pharmacies.storeMedia');
    Route::post('pharmacies/ckmedia', 'PharmaciesController@storeCKEditorImages')->name('pharmacies.storeCKEditorImages');
    Route::resource('pharmacies', 'PharmaciesController');

    // Doctors
    Route::delete('doctors/destroy', 'DoctorsController@massDestroy')->name('doctors.massDestroy');
    Route::post('doctors/media', 'DoctorsController@storeMedia')->name('doctors.storeMedia');
    Route::post('doctors/ckmedia', 'DoctorsController@storeCKEditorImages')->name('doctors.storeCKEditorImages');
    Route::resource('doctors', 'DoctorsController');

    // Appointments Statuses
    Route::delete('appointments-statuses/destroy', 'AppointmentsStatusController@massDestroy')->name('appointments-statuses.massDestroy');
    Route::resource('appointments-statuses', 'AppointmentsStatusController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::post('appointments/media', 'AppointmentsController@storeMedia')->name('appointments.storeMedia');
    Route::post('appointments/ckmedia', 'AppointmentsController@storeCKEditorImages')->name('appointments.storeCKEditorImages');
    Route::resource('appointments', 'AppointmentsController');

    // Portfolios
    Route::delete('portfolios/destroy', 'PortfoliosController@massDestroy')->name('portfolios.massDestroy');
    Route::post('portfolios/media', 'PortfoliosController@storeMedia')->name('portfolios.storeMedia');
    Route::post('portfolios/ckmedia', 'PortfoliosController@storeCKEditorImages')->name('portfolios.storeCKEditorImages');
    Route::resource('portfolios', 'PortfoliosController');

    // Payments
    Route::delete('payments/destroy', 'PaymentsController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentsController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
