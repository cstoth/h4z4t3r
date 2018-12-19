<?php

use App\Http\Controllers\PassangerController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
// Route::get('passanger',               [PassangerController::class, 'index'])->name('passanger.index');
// Route::get('passanger/list',          [PassangerController::class, 'list'])->name('passanger.list');
// Route::get('passanger/search',        [PassangerController::class, 'passangerSearch'])->name('passanger.search');

// Route::get('passanger/add',           [PassangerController::class, 'add'])->name('passanger.add');
// Route::get('passanger/edit',          [PassangerController::class, 'edit'])->name('passanger.edit');
Route::delete('passanger/{id}',       [PassangerController::class, 'delete'])->name('passanger.delete');

Route::get('passanger/get/{id}',      [PassangerController::class, 'get'])->name('passanger.get');
Route::post('passanger/set',          [PassangerController::class, 'set'])->name('passanger.set');

// routes for passanger.
// Route::group(array('prefix' => 'passanger'), function()
// {
//     Route::get('/list',         'PassangerController@list')->name('passanger.list');
//     Route::get('/search',       'PassangerController@search')->name('passanger.search');
//     Route::get('/add',          'PassangerController@add')->name('passanger.add');
//     Route::post('/add-post',    'PassangerController@addPost')->name('passanger.add-post');
//     Route::get('/delete/{id}',  'PassangerController@delete')->name('passanger.delete');
//     Route::get('/edit/{id}',    'PassangerController@edit')->name('passanger.edit');
//     Route::post('/edit-post',   'PassangerController@editPost')->name('passanger.edit-post');
//     Route::get('/view/{id}',    'PassangerController@view')->name('passanger.view');
// });
// end of passangers routes
