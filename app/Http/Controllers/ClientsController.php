<?php

namespace App\Http\Controllers;
// use App\Http\Requests\Request;
use App\Http\Requests\StoreBlogClient;
// use App\Http\Requests\StoreBlogRoom;
use App\Client;
use App\Room;

class ClientsController extends Controller
{
    public function edit($id){
        $client=Client::find('1');
        return view('clients.editprofile',[
            'client'=>$client   
        ]);
    }

    public function update(StoreBlogClient $request , $id){
        Client::where('id',1)->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        return redirect(route('allroom'));
    }

    public function index(){
        return view('reception.recephome');
    }

    public function unapprove(){
        $clients=Client::all();
        return view('reception.unapproveclient',[
            'clients'=>$clients
        ]);
    }


    public function approved(){
        $clients=Client::all();
        return view('reception.approved',[
            'clients'=>$clients
        ]);    
    }

   




}
