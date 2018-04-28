<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request\StoreBlogRoom;
// use Illuminate\Http\Request;
use App\Room;
use App\Client;

class RoomsController extends Controller
{
    public function index(){
        $rooms=Room::all();
        return view('clients.unrecervedroom',[
            'rooms'=>$rooms
        ]);
    }

    public function show($id){
        $room=Room::find($id);
        return view('clients.showrooms',[
            'room'=>$room
        ]); // obj post
    }

    public function update(StoreBlogRoom $request,$id){
        Room::where('id',$id)->update([
            'number'=>$request->number
        ]);
        return redirect(route('updatenumber'));

    }

    // public function store(StoreBlogRoom $request){
    //     Room::create([
    //         'number'=>$request->number
    //     ]);

        
       // return redirect(route('allroom'));
        // $this->validate($request, [
        //     'number' => 'required',
        // ]);
        // $room=Room::find($id);
        // $room->number=$request['number'];
        // $room->save();
    // }

}
