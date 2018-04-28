<?php
use App\Mail\welcome;
use App\Client;
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

Route::get('/admin/home','loginController@adminindex')->name('admin.index');
Route::get('/manage/home','loginController@manageindex')->name('manager.index');

Route::get('/logout','loginController@logout');

Route::get('/admin', function () {
    return view('admin_template');
});

Route::get('/admin/managers','Admin\managersController@getIndex')->name('adminmanagers');
Route::get('/admin/getManager','Admin\managersController@anyData')->name('adminmanagers.data');

//crud operations
Route::get('/admin/managers/{id}/edit','Admin\managersController@edit')->name('adminmanagers.edit');
Route::post('/admin/managers/{id}/update', 'Admin\managersController@update')->name('adminmanagers.update');

Route::get('/admin/managers/create','Admin\managersController@create')->name('adminmanagers.create');
Route::get('/admin/managers/show/{id}','Admin\managersController@show')->name('adminmanagers.show');

Route::post('/admin/managers','Admin\managersController@store')->name('adminmanagers.store');

Route::delete('/admin/managers/{id}','Admin\managersController@destroy');

//crud operations of admin receptionists 
Route::get('/admin/receptionists','Admin\receptionistsController@getIndex')->name('adminreceptionists');
Route::get('/admin/getReceptionists','Admin\receptionistsController@anyData')->name('adminreceptionists.data');

Route::get('/admin/receptionists/{id}/edit','Admin\receptionistsController@edit')->name('adminreceptionists.edit');
Route::post('/admin/receptionists/{id}/update', 'Admin\receptionistsController@update')->name('adminreceptionists.update');

Route::get('/admin/receptionists/create','Admin\receptionistsController@create')->name('adminreceptionists.create');
Route::get('/admin/receptionists/show/{id}','Admin\receptionistsController@show')->name('adminreceptionists.show');

Route::post('/admin/receptionists','Admin\receptionistsController@store')->name('adminreceptionists.store');

Route::delete('/admin/receptionists/{id}','Admin\receptionistsController@destroy');

//crud operations of admin clients 
Route::get('/admin/clients','Admin\clientsController@getIndex')->name('adminclients');
Route::get('/admin/getClients','Admin\clientsController@anyData')->name('adminclients.data');

Route::get('/admin/clients/{id}/edit','Admin\clientsController@edit')->name('adminclients.edit');
Route::post('/admin/clients/{id}/update', 'Admin\clientsController@update')->name('adminclients.update');

Route::get('/admin/clients/create','Admin\clientsController@create')->name('adminclients.create');
Route::post('/admin/clients','Admin\clientsController@store')->name('adminclients.store');

Route::get('/admin/clients/show/{id}','Admin\clientsController@show')->name('adminclients.show');
Route::delete('/admin/clients/{id}','Admin\clientsController@destroy');

Route::get('register/create','registerController@create')->name('register.create');
Route::post('/register','registerController@store')->name('register.store');

//login
Route::get('/login','loginController@login')->name('login');
Route::post('/login/loginUser','loginController@loginUser');

Route::get('/admin/clients/show','Admin\clientsController@show')->name('admin.clients.show');



Route::delete('clients/{id}','clientsController@destroy');

//statistics
Route::get('/stat','Admin\managersController@stat')->name('managers.stat');

//crud operations of manager floor 
Route::get('/manage/floor','Manage\floorController@getIndex')->name('managefloor');
Route::get('/manage/getFloor','Manage\floorController@anyData')->name('managefloor.data');


Route::get('/manage/floor/{id}/edit','Manage\floorController@edit')->name('managefloor.edit');
Route::post('/manage/floor/{id}/update', 'Manage\floorController@update')->name('managefloor.update');

Route::get('/manage/floor/create','Manage\floorController@create')->name('managefloor.create');
Route::post('/manage/floor','Manage\floorController@store')->name('managefloor.store');

Route::get('/manage/floor/show/{id}','Manage\floorController@show')->name('managefloor.show');
Route::delete('/manage/floor/{id}','Manage\floorController@destroy');

//crud operations of manager room 
Route::get('/manage/room','Manage\roomController@getIndex')->name('manageroom');
Route::get('/manage/getRoom','Manage\roomController@anyData')->name('manageroom.data');

Route::get('/manage/room/{id}/edit','Manage\roomController@edit')->name('manageroom.edit');
Route::post('/manage/room/{id}/update', 'Manage\roomController@update')->name('manageroom.update');

Route::get('/manage/room/create','Manage\roomController@create')->name('manageroom.create');
Route::post('/manage/room','Manage\roomController@store')->name('manageroom.store');

Route::get('/manage/room/show/{id}','Manage\roomController@show')->name('manageroom.show');
Route::delete('/manage/room/{id}','Manage\roomController@destroy');


//////////////////reception///////////////////
Route::get('client','MyrecervationsController@index');
Route::get('allroom','MyrecervationsController@recervation')->name('allroom');
Route::get('unrecerved','RoomsController@index')->name('unrecerved');
Route::get('show/{id}','RoomsController@show')->name('showroom');
Route::post('client/{id}/update','RoomsController@update')->name('updatenumber');
//////////////////Client//////////////////////
Route::get('allroom/{id}/edit','ClientsController@edit')->name('editprofile');
Route::post('allroom/{id}/update','ClientsController@update')->name('updateprofile');
Route::get('reception','ClientsController@index');

///////////////Email////////////////////
Route::get('/unapproved', function() {

    $clients =Client::all();
    $email = new welcome($clients);
    $when = now()->addSeconds(5);
    foreach($clients as $client){
    Mail::to($client->email)->send(($email)->delay($when));
    }
    return view('reception.unapproveclient',['clients'=>$clients]);
    
});
