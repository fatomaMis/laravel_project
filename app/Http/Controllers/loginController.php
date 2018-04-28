<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Client;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogUser;
use \Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\Input;
use Storage;
use Session;


class LoginController extends Controller
{
    
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
public function login()
{
    return view('login'); 
}
public function loginUser(Request  $request)
{
    $email=$request->email;
    $password=$request->password;
    //md5($password)
    $client=Client::where('email',$email)->where('password', $password)->first();
    $user=User::where('email',$email)
    ->where('password', $password)
    ->first();
    
    if($client){
    $clientSession=[
        'name'=>$client->name,
        'email'=>$client->email,
        'avatar_image'=>$client->avatar_image,
        'phone'=>$client->phone,
        'countries'=>$client->countr,
        'gender'=>$client->gender,
    ];
    $request->session()->put('loggedInUser', $clientSession);
    return redirect(route('client.index')); 
    }
    elseif($user){
 
    $userSession=[
        'id'=>$user->id,
        'type'=>$user->type,
        'name'=>$user->name,
        'email'=>$user->email,
        'image'=>$user->image,
        'mobile'=>$user->mobile,
        'country'=>$user->country,
        'gender'=>$user->gender,
    ];
    
    $request->session()->put('loggedInUser', $userSession);
    if($user->type == '1'){
        return redirect(route('admin.index'));
    }
    else if($user->type == '2'){
        return redirect(route('manager.index')); 
    }
    elseif($user->type == '3'){
        return redirect(route('receptionist.index')); 
    }
    }
   
   else{
    return redirect(route('login')); 
   }
}
public function adminindex(){
    //add validation here
    $clientData=Session::get('loggedInUser');
    return view('/admin/home', ['clientData' =>$clientData,
    ]); 
}
public function manageindex(){
    //add validation here
    $clientData=Session::get('loggedInUser');
    return view('/manager/home', ['clientData' =>$clientData,
    ]); 
}

public function logout(){
    Session::flush();
    return view('/login');
}
}
