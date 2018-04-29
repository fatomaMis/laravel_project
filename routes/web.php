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

Route::get('/', function () {
    return view('welcome');
});
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/','DatatablesController@getIndex')->name('datatables');
// Route::get('/getData','DatatablesController@anyData')->name('datatables.data');
//////////////////reception///////////////////
Route::get('client','MyrecervationsController@index')->name('client');
Route::get('allroom','MyrecervationsController@recervation')->name('allroom');
Route::get('unrecerved','RoomsController@index')->name('unrecerved');
Route::get('show/{id}','RoomsController@show')->name('showroom');
Route::post('client/{id}/update','RoomsController@update')->name('updatenumber');
// Route::get ('reservations/create/{room_id}','MyrecervationsController@create');
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



