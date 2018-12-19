<?php

use App\Http\Controllers\CarController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::delete('car/{id}',       [CarController::class, 'delete'])->name('car.delete');

Route::get('car/get/{id}',      [CarController::class, 'get'])->name('car.get');
Route::post('car/set',          [CarController::class, 'set'])->name('car.set');

