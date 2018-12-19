<?php

use App\Http\Controllers\Backend\Datasets\CityController;
use App\Http\Controllers\Backend\Datasets\CarController;

/*
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'datasets',
    'as'         => 'datasets.',
    'namespace'  => 'Datasets',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    /*
     * City Management
     */
    Route::group(['namespace' => 'City'], function () {
        Route::get('city', [CityController::class, 'index'])->name('city.index');
        Route::get('city/create', [CityController::class, 'create'])->name('city.create');
        Route::post('city', [CityController::class, 'store'])->name('city.store');

        Route::group(['prefix' => 'city/{city}'], function () {
            Route::get('/', [CityController::class, 'show'])->name('city.show');
            Route::get('edit', [CityController::class, 'edit'])->name('city.edit');
            Route::patch('/', [CityController::class, 'update'])->name('city.update');
            Route::delete('/', [CityController::class, 'destroy'])->name('city.destroy');
        });
    });

    /*
     * Car Management
     */
    Route::group(['namespace' => 'Car'], function () {
        Route::get('car', [CarController::class, 'index'])->name('car.index');
        Route::get('car/create', [CarController::class, 'create'])->name('car.create');
        Route::post('car', [CarController::class, 'store'])->name('car.store');

        Route::group(['prefix' => 'car/{car}'], function () {
            Route::get('/', [CarController::class, 'show'])->name('car.show');
            Route::get('edit', [CarController::class, 'edit'])->name('car.edit');
            Route::patch('/', [CarController::class, 'update'])->name('car.update');
            Route::delete('/', [CarController::class, 'destroy'])->name('car.destroy');
        });
    });
});
