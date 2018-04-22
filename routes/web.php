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
