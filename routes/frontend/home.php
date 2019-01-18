<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\Datasets\AdvertiseController;
use App\Http\Controllers\PassangerController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\Frontend\MessagesController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\Frontend\Datasets\CityController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('search/city', [HomeController::class, 'typeaheadCity'])->name('search.city');
Route::get('search/name', [HomeController::class, 'typeaheadName'])->name('search.name');
Route::get('search/advertise', [HomeController::class, 'searchAdvertise'])->name('search.advertise');
Route::get('search', [HomeController::class, 'search'])->name('search');
Route::post('find', [HomeController::class, 'findPost'])->name('find');
Route::get('find', [HomeController::class, 'findGet'])->name('find');
Route::get('howitworks', [HomeController::class, 'howitworks'])->name('howitworks');
Route::get('terms', [HomeController::class, 'terms'])->name('terms');
Route::get('dataprotection', [HomeController::class, 'dataprotection'])->name('dataprotection');
Route::get('user/list', [HomeController::class, 'userList'])->name('user.list');

Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('advertise', [AdvertiseController::class, 'index'])->name('advertise');
Route::delete('advertise/{id}',         [AdvertiseController::class, 'delete'])->name('advertise.delete');
//Route::get('advertise/get/{id}',        [AdvertiseController::class, 'get'])->name('advertise.get');
//Route::post('advertise/set',            [AdvertiseController::class, 'set'])->name('advertise.set');
Route::get('advertise/reserve/{id}',    [AdvertiseController::class, 'reserve'])->name('advertise.reserve');

Route::delete('passanger/{id}',       [PassangerController::class, 'delete'])->name('passanger.delete');
Route::get('passanger/get/{id}',      [PassangerController::class, 'get'])->name('passanger.get');
Route::post('passanger/set',          [PassangerController::class, 'set'])->name('passanger.set');

Route::delete('messages/{id}',      [MessagesController::class, 'delete'])->name('messages.delete');
Route::get('messages/get/{id}',     [MessagesController::class, 'get'])->name('messages.get');
Route::get('messages/read/{id}',    [MessagesController::class, 'read'])->name('messages.read');
Route::post('messages/set',         [MessagesController::class, 'set'])->name('messages.set');
Route::post('messages/search',      [MessagesController::class, 'search'])->name('messages.search');

Route::get('city/query',    [CityController::class, 'query'])->name('city.query');
Route::get('city/get/{id}', [CityController::class, 'get'])->name('city.get');

Route::delete('car/{id}',       [CarController::class, 'delete'])->name('car.delete');
Route::get('car/get/{id}',      [CarController::class, 'get'])->name('car.get');
Route::post('car/set',          [CarController::class, 'set'])->name('car.set');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        //Route::get('dashboard/message-search', [DashboardController::class, 'messageSearch'])->name('dashboard.message-search');

        Route::get('drivermenu', [AdvertiseController::class, 'driverMenu'])->name('driver.menu');
        Route::get('drivercars', [AdvertiseController::class, 'driverCars'])->name('driver.cars');
        Route::get('passangermenu', [PassangerController::class, 'passangerMenu'])->name('passanger.menu');
        Route::get('advertises', [AdvertiseController::class, 'list'])->name('advertise.list');
        Route::get('advertise/add', [AdvertiseController::class, 'add'])->name('advertise.add');
        Route::get('advertise/resign', [AdvertiseController::class, 'resign'])->name('advertise.resign');
        Route::post('template/save', [AdvertiseController::class, 'saveTemplate'])->name('template.save');
        Route::get('template/load', [AdvertiseController::class, 'loadTemplate'])->name('template.load');
        Route::post('advertise', [AdvertiseController::class, 'store'])->name('advertise.store');

        Route::get('passangers', [PassangerController::class, 'list'])->name('passanger.list');
        Route::get('cars', [CarController::class, 'list'])->name('car.list');

        Route::get('messages', [MessagesController::class, 'list'])->name('messages.list');

        Route::get('tab/set', [HomeController::class, 'setTab'])->name('tab.set');

        /*
         * User Account Specific
         */
        Route::get('account', [AccountController::class, 'index'])->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile/delete/{id}', [ProfileController::class, 'delete'])->name('profile.delete');

        /*
         * Reserve Management
         */
        Route::group(['namespace' => 'Reserve'], function () {
            Route::get('reserve', [ReserveController::class, 'index'])->name('reserve.index');
            Route::get('reserve/create', [ReserveController::class, 'create'])->name('reserve.create');
            Route::post('reserve', [ReserveController::class, 'store'])->name('reserve.store');

            Route::group(['prefix' => 'reserve/{reserve}'], function () {
                Route::get('/', [ReserveController::class, 'show'])->name('reserve.show');
                Route::get('edit', [ReserveController::class, 'edit'])->name('reserve.edit');
                Route::patch('/', [ReserveController::class, 'update'])->name('reserve.update');
                Route::delete('/', [ReserveController::class, 'destroy'])->name('reserve.destroy');
            });
        });

    });
});

// Route::get('/clear-cache', function() {
//     $exitCode = Artisan::call('config:clear');
//     $exitCode = Artisan::call('cache:clear');
//     $exitCode = Artisan::call('config:cache');
//     return 'DONE'; //Return anything
// });
