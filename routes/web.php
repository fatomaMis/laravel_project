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

//crud operations of admin receptionists 
Route::get('receptionists','receptionistsController@getIndex')->name('receptionists');
Route::get('/getReceptionists','receptionistsController@anyData')->name('receptionists.data');

Route::get('receptionists/{id}/edit','receptionistsController@edit')->name('receptionists.edit');
Route::post('receptionists/{id}/update', 'receptionistsController@update')->name('receptionists.update');

Route::get('receptionists/create','receptionistsController@create')->name('receptionists.create');
Route::get('receptionists/show/{id}','receptionistsController@show')->name('receptionists.show');

Route::post('receptionists','receptionistsController@store')->name('receptionists.store');

Route::delete('receptionists/{id}','receptionistsController@destroy');

//crud operations of admin clients 
Route::get('clients','clientsController@getIndex')->name('clients');
Route::get('/getClients','clientsController@anyData')->name('clients.data');

Route::get('clients/{id}/edit','clientsController@edit')->name('clients.edit');
Route::post('clients/{id}/update', 'clientsController@update')->name('clients.update');

Route::get('clients/create','clientsController@create')->name('clients.create');
Route::get('clients/login','clientsController@login')->name('clients.login');
Route::post('clients/loginUser','clientsController@loginUser');

Route::get('clients/show','clientsController@show')->name('clients.show');

Route::post('clients/store','clientsController@store')->name('clients.store');

Route::delete('clients/{id}','clientsController@destroy');

//statistics
Route::get('/stat','managersController@stat')->name('managers.stat');
Route::get('api/clients/getGenderStat','clientsController@getGenderStat');
Route::get('api/clients/getContriesStat','clientsController@getContriesStat');
