<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests\StoreBlogRoom;
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

    // public function update(StoreBlogRoom $request,$id){
    //     // $capacity=Room::find($id)->capacity;
    //     // if($capacity < $request->number){

    //         DB::table('myreservations')
    //         ->where('id',$id)
    //         ->update([
    //         'accompany_number'=>$request['number']
    //     ]);

    //     // DB::table('rooms')
    //     // ->where('id', $id)
    //     // ->update(['number' => $request['number']]);  
        
    //     return redirect(route('client'));
    //     }
        // else{
        //     return redirect(route('unrecerved'));
        // }

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
    

    // public function accompany(){
         
    // }

}
