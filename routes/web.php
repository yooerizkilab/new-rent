<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'role:administrator|operator'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    // dasboard
    Route::get('/home', 'HomeController@index')->name('home');

    // cars
    Route::get('/cars', 'CarController@index')->name('cars');
    Route::get('/cars/create', 'CarController@create')->name('cars.create');
    Route::post('/cars', 'CarController@store')->name('cars.store');
    Route::get('/cars/{car}', 'CarController@show')->name('cars.show');
    Route::get('/cars/{car}/edit', 'CarController@edit')->name('cars.edit');
    Route::put('/cars/{car}', 'CarController@update')->name('cars.update');
    Route::delete('/cars/{car}', 'CarController@destroy')->name('cars.destroy');

    //customers
    Route::get('/customers', 'CustomerController@index')->name('customers');
    Route::get('/customers/create', 'CustomerController@create')->name('customers.create');
    Route::post('customers', 'CustomerController@store')->name('customers.store');
    Route::get('/customers/{customer}', 'CustomerController@show')->name('customers.show');
    Route::get('/customers/{customer}/edit', 'CustomerController@edit')->name('customers.edit');
    Route::put('/customers/{customer}', 'CustomerController@update')->name('customers.update');
    Route::delete('/customers/{customer}', 'CustomerController@destroy')->name('customers.destroy');

    //bookings
    Route::get('/bookings', 'BookingController@index')->name('bookings');
    Route::get('/bookings/create', 'BookingController@create')->name('bookings.create');
    Route::post('/bookings', 'BookingController@store')->name('bookings.store');
    Route::get('/bookings/{booking}', 'BookingController@show')->name('bookings.show');
    Route::get('/bookings/{booking}/edit', 'BookingController@edit')->name('bookings.edit');
    Route::put('/bookings/{booking}', 'BookingController@update')->name('bookings.update');
    Route::delete('/bookings/{booking}', 'BookingController@destroy')->name('bookings.destroy');

    // transactions
    Route::get('/transactions', 'TransactionController@index')->name('transactions');
    Route::get('/transactions/create', 'TransactionController@create')->name('transactions.create');
    Route::post('/transactions', 'TransactionController@store')->name('transactions.store');
    Route::get('/transactions/{transaction}', 'TransactionController@show')->name('transactions.show');
    Route::get('/transactions/{transaction}/edit', 'TransactionController@edit')->name('transactions.edit');
    Route::put('/transactions/{transaction}', 'TransactionController@update')->name('transactions.update');
    Route::delete('/transactions/{transaction}', 'TransactionController@destroy')->name('transactions.destroy');

    //maintenance
    Route::get('/maintenance', 'MaintenanceController@index')->name('maintenance');
    Route::get('/maitenance/create', 'MaintenanceController@create')->name('maintenance.create');
    Route::post('/maintenance', 'MaintenanceController@store')->name('maintenance.store');
    Route::get('/maintenance/{maintenance}', 'MaintenanceController@show')->name('maintenance.show');
    Route::get('/maintenance/{maintenance}/edit', 'MaintenanceController@edit')->name('maintenance.edit');
    Route::put('/maintenance/{maintenance}', 'MaintenanceController@update')->name('maintenance.update');
    Route::delete('/maintenance/{maintenance}', 'MaintenanceController@destroy')->name('maintenance.destroy');

    //reviews
    Route::get('/reviews', 'ReviewController@index')->name('reviews');
    Route::get('/reviews/create', 'ReviewController@create')->name('reviews.create');
    Route::post('/reviews', 'ReviewController@store')->name('reviews.store');
    Route::get('/reviews/{review}', 'ReviewController@show')->name('reviews.show');
    Route::get('/reviews/{review}/edit', 'ReviewController@edit')->name('reviews.edit');
    Route::put('/reviews/{review}', 'ReviewController@update')->name('reviews.update');
    Route::delete('/reviews/{review}', 'ReviewController@destroy')->name('reviews.destroy');

    //promotions
    Route::get('/promotions', 'PromotionController@index')->name('promotions');
    Route::get('/promotions/create', 'PromotionController@create')->name('promotions.create');
    Route::post('/promotions', 'PromotionController@index')->name('promotions.store');
    Route::get('/promotions/{promotion}', 'PromotionController@show')->name('promotions.show');
    Route::get('/promotions/{promotion}/edit', 'PromotionController@edit')->name('promotions.edit');
    Route::put('/promotions/{promotion}', 'PromotionController@update')->name('promotions.update');
    Route::delete('/promotions/{promotion}', 'PromotionController@destroy')->name('promotions.destroy');

    //drivers
    Route::get('/drivers', 'DriverController@index')->name('drivers');
    Route::get('/drivers/create', 'DriverController@create')->name('drivers.create');
    Route::post('/drivers', 'DriverController@store')->name('drivers.store');
    Route::get('/drivers/{driver}', 'DriverController@show')->name('drivers.show');
    Route::get('/drivers/{driver}/edit', 'DriverController@edit')->name('drivers.edit');
    Route::put('/drivers/{driver}', 'DriverController@update')->name('drivers.update');
    Route::delete('/drivers/{driver}', 'DriverController@destroy')->name('drivers.destroy');

    //cars_drivers
    Route::get('/cars_drivers', 'CarDriverController@index')->name('cars_drivers');
    Route::get('/cars_drivers/create', 'CarDriverController@create')->name('cars_drivers.create');
    Route::post('/cars_drivers', 'CarDriverController@store')->name('cars_drivers.store');
    Route::get('/cars_drivers/{cars_driver}', 'CarDriverController@show')->name('cars_drivers.show');
    Route::get('/cars_drivers/{cars_driver}/edit', 'CarDriverController@edit')->name('cars_drivers.edit');
    Route::put('/cars_drivers/{cars_driver}', 'CarDriverController@update')->name('cars_drivers.update');
    Route::delete('/cars_drivers/{cars_driver}', 'CarDriverController@destroy')->name('cars_drivers.destroy');

    //deliverys
    Route::get('/deliveries', 'DeliveryLocationController@index')->name('deliveries');
    Route::get('/deliveries/create', 'DeliveryLocationController@create')->name('deliveries.create');
    Route::post('/deliveries', 'DeliveryLocationController@store')->name('deliveries.store');
    Route::get('/deliveries/{delivery}', 'DeliveryLocationController@show')->name('deliveries.show');
    Route::get('/deliveries/{delivery}/edit', 'DeliveryLocationController@edit')->name('deliveries.edit');
    Route::put('/deliveries/{delivery}', 'DeliveryLocationController@update')->name('deliveries.update');
    Route::delete('/deliveries/{delivery}', 'DeliveryLocationController@destroy')->name('deliveries.destroy');

    // test feature
    Route::get('/test', 'TestingController@index')->name('test');
    Route::post('/test', 'TestingController@store')->name('test.store');
});

Route::group(['middleware' => 'auth', 'prefix' => 'settings', 'as' => 'settings.'], function () {

    // setting user
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users', 'UsersController@store')->name('users.store');
    Route::get('/users/{user}', 'UsersController@show')->name('users.show');
    Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
    Route::put('/users/{user}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

    // setting role
    Route::get('/roles', 'UserRoleController@index')->name('roles');
    Route::get('/roles/create', 'UserRoleController@create')->name('roles.create');
    Route::post('/roles', 'UserRoleController@store')->name('roles.store');
    Route::get('/roles/{role}', 'UserRoleController@show')->name('roles.show');
    Route::get('/roles/{role}/edit', 'UserRoleController@edit')->name('roles.edit');
    Route::put('/roles/{role}', 'UserRoleController@update')->name('roles.update');
    Route::delete('/roles/{role}', 'UserRoleController@destroy')->name('roles.destroy');
    // manage role
    Route::get('/role/{role}/manage', 'UserRoleController@assignPermission')->name('roles.manage');
    Route::put('/role/{role}/manage', 'UserRoleController@assignPermissionStore')->name('roles.manage.store');

    // setting permission
    Route::get('/permissions', 'PermissionsController@index')->name('permissions');
    Route::get('/permissions/create', 'PermissionsController@create')->name('permissions.create');
    Route::post('/permissions', 'PermissionsController@store')->name('permissions.store');
    Route::get('/permissions/{permission}', 'PermissionsController@show')->name('permissions.show');
    Route::get('/permissions/{permission}/edit', 'PermissionsController@edit')->name('permissions.edit');
    Route::put('/permissions/{permission}', 'PermissionsController@update')->name('permissions.update');
    Route::delete('/permissions/{permission}', 'PermissionsController@destroy')->name('permissions.destroy');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    Route::get('/about', function () {
        return view('backend.settings.about');
    })->name('about');
});
