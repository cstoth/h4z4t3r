<?php

use App\Http\Controllers\LanguageController;
use Yajra\DataTables\Html\Builder;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Artisan;

/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);

Route::get('main-menu/{id}', [HomeController::class, 'mainMenu']);
Route::get('sub-menu/{id}', [HomeController::class, 'subMenu']);

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    include_route_files(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */
    include_route_files(__DIR__.'/backend/');
});

//Route::resource('reserve', 'ReserveController', ['except' => []]);
// Route::controllers([
//     'reserve'   => 'ReserveController',
// ]);

//Route::resource('reserve', 'ReserveController');
// Route::get('reserve', function(Builder $builder) {
// });

// Route::get('{view}', function ($view) {
//     if (view()->exists($view)) {
//         return view($view);
//     }

//     return app()->abort(404, 'Page not found!');
// });
