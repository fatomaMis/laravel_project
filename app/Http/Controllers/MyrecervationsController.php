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

    public function store(Request $request,$room_id)
    {
        $room=Room::find($room_id);
            Validator::make($request->all(), [
                
                'accompany_number' => 'required|numeric|max:'.$room->capacity,
            ], [
                'max' => "The Number Of Companions Must Be less Than Or Equal $room->capacity",
            ])->validate();
            Reservation::create([
                'room_id' =>$room_id,
                'client_id' =>$client_id,
                 'price' =>$paid_price,
                'accompany_number'=>$request->accompany_number,
               ]);
               $room->is_reserved=1;
               $room->save();
            return redirect('client');
    }

}
