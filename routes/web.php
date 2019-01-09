<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('view'));
});

// Route::get('/', 'UserController@index')->name('view');

Route::get('/', function(){
    return view('index');
})->name('view');

Route::group(['prefix'=>'books'], function(){
    Route::get('/', 'BookController@index')->name('books');
    Route::get('/archive', 'BookController@archive')->name('archive');
    Route::get('add', 'BookController@create')->name('create');
    Route::post('store', 'BookController@store')->name('insert');
    Route::post('edit', 'BookController@edit')->name('edit');
    Route::post('update', 'BookController@update')->name('save');
    Route::post('delete', 'BookController@destroy')->name('delete');
});
