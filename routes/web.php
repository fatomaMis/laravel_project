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

Route::get('/','DatatablesController@getIndex')->name('datatables');
Route::get('/getData','DatatablesController@anyData')->name('datatables.data');

Route::get('/admin', function () {
    return view('admin_template');
});

Route::get('managers','managersController@getIndex')->name('managers');
Route::get('/getManager','managersController@anyData')->name('managers.data');

//crud operations
Route::get('managers/{id}/edit','managersController@edit')->name('managers.edit');
Route::post('managers/{id}/update', 'managersController@update')->name('managers.update');

Route::get('managers/create','managersController@create')->name('managers.create');
Route::get('managers/show/{id}','managersController@show')->name('managers.show');

Route::post('managers','managersController@store')->name('managers.store');

Route::delete('managers/{id}','managersController@destroy');

