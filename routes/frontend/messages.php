<?php

use App\Http\Controllers\Frontend\MessagesController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
// Route::get('messages',              [MessagesController::class, 'index'])->name('messages.index');
// Route::get('messages/view/{id}',    [MessagesController::class, 'view'])->name('messages.view');
// Route::get('messages/list',         [MessagesController::class, 'list'])->name('messages.list');
// Route::get('messages/search',       [MessagesController::class, 'messageSearch'])->name('messages.search');

// Route::get('messages/add',          [MessagesController::class, 'add'])->name('messages.add');
// Route::get('messages/edit',         [MessagesController::class, 'edit'])->name('messages.edit');
Route::delete('messages/{id}',      [MessagesController::class, 'delete'])->name('messages.delete');

Route::get('messages/get/{id}',     [MessagesController::class, 'get'])->name('messages.get');
Route::get('messages/read/{id}',    [MessagesController::class, 'read'])->name('messages.read');
Route::post('messages/set',         [MessagesController::class, 'set'])->name('messages.set');
Route::post('messages/search',      [MessagesController::class, 'search'])->name('messages.search');

// routes for message.
// Route::group(array('prefix' => 'messages'), function()
// {
//     Route::get('/list',         'MessagesController@list')->name('messages.list');
//     Route::get('/search',       'MessagesController@search')->name('messages.search');
//     Route::get('/add',          'MessagesController@add')->name('messages.add');
//     Route::post('/add-post',    'MessagesController@addPost')->name('messages.add-post');
//     Route::get('/delete/{id}',  'MessagesController@delete')->name('messages.delete');
//     Route::get('/edit/{id}',    'MessagesController@edit')->name('messages.edit');
//     Route::post('/edit-post',   'MessagesController@editPost')->name('messages.edit-post');
//     Route::get('/view/{id}',    'MessagesController@view')->name('messages.view');
// });
// end of message routes
