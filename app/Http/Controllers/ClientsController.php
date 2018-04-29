<?php

namespace App\Http\Controllers;
// use App\Http\Requests\Request;
use App\Http\Requests\StoreBlogClient;
use App\Client;
use Illuminate\Http\Request;
use App\Room;
use Session;
class ClientsController extends Controller
{
    public function edit($id){
        $clientData=Session::get('loggedInUser');
        
        $client=Client::where('email',$clientData['email']) -> first();
        if($client){
        return view('clients.editprofile',[
            'client'=>$client   
        ]);
        }
        else{
            return view('clients.myhome');
        }
    }

    public function update(Request $request , $id){
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required'
        ]);

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
