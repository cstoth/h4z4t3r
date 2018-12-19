<?php

use App\Http\Controllers\AdvertiseController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
// Route::get('advertise',               [AdvertiseController::class, 'index'])->name('advertise.index');
// Route::get('advertise/list',          [AdvertiseController::class, 'list'])->name('advertise.list');
// Route::get('advertise/search',        [AdvertiseController::class, 'advertiseSearch'])->name('advertise.search');

// Route::get('advertise/edit',          [AdvertiseController::class, 'edit'])->name('advertise.edit');
Route::delete('advertise/{id}',         [AdvertiseController::class, 'delete'])->name('advertise.delete');

Route::get('advertise/get/{id}',        [AdvertiseController::class, 'get'])->name('advertise.get');
Route::post('advertise/set',            [AdvertiseController::class, 'set'])->name('advertise.set');
Route::get('advertise/reserve/{id}',    [AdvertiseController::class, 'reserve'])->name('advertise.reserve');

// routes for advertise.
// Route::group(array('prefix' => 'advertise'), function()
// {
//     Route::get('/list',         'AdvertiseController@list')->name('advertise.list');
//     Route::get('/search',       'AdvertiseController@search')->name('advertise.search');
//     Route::get('/add',          'AdvertiseController@add')->name('advertise.add');
//     Route::post('/add-post',    'AdvertiseController@addPost')->name('advertise.add-post');
//     Route::get('/delete/{id}',  'AdvertiseController@delete')->name('advertise.delete');
//     Route::get('/edit/{id}',    'AdvertiseController@edit')->name('advertise.edit');
//     Route::post('/edit-post',   'AdvertiseController@editPost')->name('advertise.edit-post');
//     Route::get('/view/{id}',    'AdvertiseController@view')->name('advertise.view');
// });
// end of advertises routes
