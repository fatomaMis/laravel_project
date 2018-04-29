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
use Spatie\Permission\Models\Role;
use App\User;

Route::get('/','DatatablesController@getIndex')->name('datatables');
Route::get('/getData','DatatablesController@anyData')->name('datatables.data');

Route::get('/admin', function () {
    return view('admin_template');
});
Route::get('/test', function () {
    //$role = Role::create(['name' => 'admin']);
    $user = User::all();
    return $user;
    Role::create(['name'=> 'admin']);
    Role::create(['name'=> 'manager']);  
    Role::create(['name'=> 'receptionist']);
    Role::create(['name'=> 'client']);

   
});

Route::get('managers','managersController@getIndex')->name('managers');
Route::get('/getManager','managersController@anyData')->name('managers.data');

// //crud operations of admin manager
// Route::get('managers/{id}/edit','managersController@edit')->name('managers.edit');
// Route::post('managers/{id}/update', 'managersController@update')->name('managers.update');

// Route::get('managers/create','managersController@create')->name('managers.create');
// Route::get('managers/show/{id}','managersController@show')->name('managers.show');

// Route::post('managers','managersController@store')->name('managers.store');

// Route::delete('managers/{id}','managersController@destroy');


//crud for manager/receptionist 
Route::get('manager/receptionists','ReceptionistController@index')->name('receptionists');
Route::get('manager/data','ReceptionistController@datatable')->name('receptionists.data');

Route::get('manager/receptionists/{id}/edit','ReceptionistController@edit')->name('receptionists.edit');
Route::post('manager/receptionists/{id}/update', 'ReceptionistController@update')->name('receptionists.update');

Route::get('manager/receptionists/create','ReceptionistController@create')->name('receptionists.create');
Route::get('manager/receptionists/show/{id}','ReceptionistController@show')->name('receptionists.show');

Route::post('manager/receptionists','ReceptionistController@store')->name('receptionists.store');

Route::delete('manager/receptionists/{id}','ReceptionistController@destroy');

Route::get('ban/{id}','ReceptionistController@ban')->name('ban');
//Route::get('manager/receptionists/{id}/unban','ReceptionistController@unban');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




//crud for manager/floors 
Route::get('manager/floors','FloorController@index')->name('floors');
Route::get('/data','FloorController@datatable')->name('floors.data');

Route::get('manager/floors/{id}/edit','FloorController@edit')->name('floors.edit');
Route::post('manager/floors/{id}/update', 'FloorController@update')->name('floors.update');

Route::get('manager/floors/create','FloorController@create')->name('floors.create');

Route::post('manager/floors','FloorController@store')->name('floors.store');

Route::delete('manager/floors/{id}','FloorController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

