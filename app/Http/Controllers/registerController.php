<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Client;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogClient;
use \Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\Input;
use Storage;
use Session;


class RegisterController extends Controller
{
    
    public function create(){
        $countries = countries();    
        $keys = array_keys($countries);
        
        return view('register',[
            'countries'=>$countries,
            'keys'=>$keys,
        ]);
    }
    
    public function store(StoreBlogClient $request)
    {  
        if($request->avatar_image == null){
            $destinationPath = 'img/avatar.jpg';
        }
        else{
        $file = $request->file('avatar_image');
        $fileName = $file->getClientOriginalName();
        $extension =  pathinfo($fileName);
        $fileName = $request->id.'.'.$extension["extension"];
        $destinationPath = 'img/'.$fileName;
        $file->move(public_path().'/img/',$fileName);
        }
        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'avatar_image' => $destinationPath,
            'phone' => $request->phone,
            'countries' => $request->countries,
            'gender' => $request->gender
        ]);
        
        $userSession=[
            'name'=>$request->name,
            'email'=>$request->email,
            'avatar_image'=>$request->avatar_image,
            'phone'=>$request->phone,
            'countries'=>$request->countries,
            'gender'=>$request->gender,
        ];

       $request->session()->put('loggedInUser', $userSession);
       return redirect(route('register.store')); 
}
}
 
 
