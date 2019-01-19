<?php

use App\Http\Controllers\Frontend\Datasets\CityController;
use App\Http\Controllers\Frontend\Datasets\CarController;
use App\Http\Controllers\Frontend\Datasets\MessageController;
use App\Http\Controllers\Frontend\Datasets\AdvertiseController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\Frontend\Datasets\HunterController;

/*
 * All route names are prefixed with 'admin.auth'.
 */
Route::group([
    'prefix'     => 'datasets',
    'as'         => 'datasets.',
    'namespace'  => 'Datasets',
    // 'middleware' => 'role:'.config('access.users.admin_role'),
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

        Route::get('car/{id}', [CarController::class, 'get'])->name('car.get');
    });

    /*
     * Message Management
     */
    Route::group(['namespace' => 'Messages'], function () {
        Route::get('message', [MessageController::class, 'index'])->name('message.index');
        Route::get('message/create', [MessageController::class, 'create'])->name('message.create');
        Route::post('message', [MessageController::class, 'store'])->name('message.store');

        Route::group(['prefix' => 'message/{message}'], function () {
            Route::get('/', [MessageController::class, 'show'])->name('message.show');
            Route::get('edit', [MessageController::class, 'edit'])->name('message.edit');
            Route::patch('/', [MessageController::class, 'update'])->name('message.update');
            Route::delete('/', [MessageController::class, 'destroy'])->name('message.destroy');
        });
    });

    /*
     * Advertise Management
     */
    Route::group(['namespace' => 'Advertise'], function () {
        Route::get('advertise', [AdvertiseController::class, 'index'])->name('advertise.index');
        Route::get('advertise/create', [AdvertiseController::class, 'create'])->name('advertise.create');
        Route::post('advertise', [AdvertiseController::class, 'store'])->name('advertise.store');

        Route::group(['prefix' => 'advertise/{advertise}'], function () {
            Route::get('/', [AdvertiseController::class, 'show'])->name('advertise.show');
            Route::get('edit', [AdvertiseController::class, 'edit'])->name('advertise.edit');
            Route::get('copy', [AdvertiseController::class, 'copy'])->name('advertise.copy');
            Route::post('close', [AdvertiseController::class, 'close'])->name('advertise.close');
            Route::get('rate', [AdvertiseController::class, 'rate'])->name('advertise.rate');
            Route::patch('/', [AdvertiseController::class, 'update'])->name('advertise.update');
            //Route::delete('/', [AdvertiseController::class, 'destroy'])->name('advertise.destroy');
        });
    });

    /*
     * Hunter Management
     */
    Route::group(['namespace' => 'Hunter'], function () {
        Route::get('hunter', [HunterController::class, 'index'])->name('hunter.index');
        Route::get('hunter/create', [HunterController::class, 'create'])->name('hunter.create');
        Route::post('hunter', [HunterController::class, 'store'])->name('hunter.store');

        Route::group(['prefix' => 'hunter/{hunter}'], function () {
            Route::get('/', [HunterController::class, 'show'])->name('hunter.show');
            Route::get('edit', [HunterController::class, 'edit'])->name('hunter.edit');
            Route::patch('/', [HunterController::class, 'update'])->name('hunter.update');
            Route::delete('/', [HunterController::class, 'destroy'])->name('hunter.destroy');
        });
    });
});
