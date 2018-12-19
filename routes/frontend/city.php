<?php

use App\Http\Controllers\Frontend\Datasets\CityController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('city/query',    [CityController::class, 'query'])->name('city.query');
Route::get('city/get/{id}', [CityController::class, 'get'])->name('city.get');
