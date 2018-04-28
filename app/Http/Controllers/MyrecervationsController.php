<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Client;
use App\Myrecervation;

class MyrecervationsController extends Controller
{
    public function index(){
        return view('clients.myhome');
    }
    
    public function recervation(){
        $reservations=Myrecervation::all();
        return view('clients.myrecerve',[
            'reservations'=> $reservations
        ]);
    }

}
