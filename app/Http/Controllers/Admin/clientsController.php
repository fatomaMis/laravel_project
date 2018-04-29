<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Client;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogUser;
use App\Http\Requests\StoreBlogClient;
use \Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\Input;
use Storage;
use Session;


class clientsController extends Controller
{
    
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    { 
        $clients = Client::all();
        $clientData=Session::get('loggedInUser');
        if($clientData == null){
            return view('login');
        }
        else if($clientData['type']==1){
        return view('admin.clients.index',[
            'clients' => $clients,
            'clientData' =>$clientData,
        ]);
    }

    else{
        return view('login');
    }
}

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $clients = Client::all();

        $receptionists = User::where('type', 3)->get();
        $i = 0;
        $keys = array();
        $id = array();
        $count=0;
        foreach ($clients as $client)
        {
            $id[$i]=$client->id;
            $i++;
        }
        foreach($receptionists as $receptionist){
            
            for ($j=0;$j<count($id);$j++){
                if($receptionist->receptionist_client == $id[$j]){  
                    $keys[$count] = $receptionist->id;
                    $count++;
                }
            }
            
            if($count>0 && !$keys[$count-1]){
                $keys[$count-1]=null;
            }
            elseif($count == 0){
                $keys[]=null;
            }
        }
        if(count($id)>count($keys)){
            for($num=count($keys);$num<=count($id);$num++){
                $keys[$num]=null;
            }
        }
            $l=0;
           foreach ($clients as $client){
            $client->receptionist = $keys[$l];
            $l++;
           }

        return Datatables::of($clients)
        ->addColumn('action', function ($clients) {
        })
        ->make(true);
    }

    public function create(){
        $clientData=Session::get('loggedInUser');
        $countries = countries();    
        $keys = array_keys($countries);
        $receptionists=User::all();
        
        return view('admin.clients.create',[
            'countries'=>$countries,
            'keys'=>$keys,
            'clientData' =>$clientData,
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
            'password' => md5($request->password),
            'avatar_image' => $destinationPath,
            'countries' => $request->countries,
            'gender' => $request->gender
        ]);

       return redirect(route('adminclients')); 
}

public function show($id){
    //add validation here
    $clientData=Session::get('loggedInUser');
    return view('admin.clients.show', ['client' => Client::findOrFail($id),
    'clientData' => $clientData,
    ]); 
}
public function destroy($id)
{
    Client::destroy($id);
    return response()->json([
        'success' => 'Record has been deleted successfully!'
    ]);
}
public function edit($id){
    $clientData=Session::get('loggedInUser');
    $countries = countries();    
    $keys = array_keys($countries);
    $clients=Client::all();
    
    return view('admin.clients.edit',['client'=> Client::findOrFail($id),
    'clients'=>$clients,
    'countries'=>$countries,
    'keys'=>$keys,
    'clientData' => $clientData,
    ]);
}
public function update(Request  $request,$id)
{
    $this->validate(request(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6',
        'image' => 'image|mimes:jpg,jpeg'
    ]);
    
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
    Client::where('id',$id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'avatar_image' => $destinationPath,
        'countries' => $request->countries,
        'gender' => $request->gender
    ]);
    return redirect(route('adminclients'));
}
}
 
