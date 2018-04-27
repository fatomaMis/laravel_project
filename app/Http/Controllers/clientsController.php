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


class clientsController extends Controller
{
    
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    { 
        $receptionists = User::where('type', 3)->get();
        
        return view('clients.index',[
            'clients' => $clients
        ]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        //$user=User::query();
        $clients = Client::all();
        $receptionist = User::all();
        $i=0;
        foreach ($clients as $client)
            {
                $id[$i] = $receptionist->receptionist_client;
            }
           
        return Datatables::of($receptionists)
        ->addColumn('action', function ($receptionists) {
        })
        ->addColumn('manager', function ($id) {
            return $id->manage_receptionist;
        })
        ->make(true);
    }

    public function create(){
        $countries = countries();    
        $keys = array_keys($countries);
        $receptionists=User::all();
        
        return view('clients.create',[
            'countries'=>$countries,
            'keys'=>$keys,
        ]);
    }
    
    public function store(StoreBlogUser $request)
    {  
        if($request->image == null){
            $destinationPath = 'img/avatar.jpg';
        }
        else{
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $extension =  pathinfo($fileName);
        $fileName = $request->id.'.'.$extension["extension"];
        $destinationPath = 'img/'.$fileName;
        $file->move(public_path().'/img/',$fileName);
        }
        Client::create([
            'id' => $request->id,
            'name' => $request->name,
            'type' => "3",
            'email' => $request->email,
            'password' => md5($request->password),
            'image' => $destinationPath,
            'mobile' => $request->mobile,
            'country' => $request->country,
            'gender' => $request->gender
        ]);
        
        $userSession=[
            'name'=>$request->name,
            'type'=>'3',
            'email'=>$request->email,
            'image'=>$request->image,
            'mobile'=>$request->mobile,
            'country'=>$request->country,
            'gender'=>$request->gender,
        ];

        $request->session()->put('loggedInUser', $userSession);
       return redirect(route('clients.show')); 
}

public function show(){
    //add validation here
    $clientData=Session::get('loggedInUser');
    
    return view('clients.show', ['clientData' =>$clientData,
                                   
    ]); 
}
public function destroy($id)
{
    User::destroy($id);
    return response()->json([
        'success' => 'Record has been deleted successfully!'
    ]);
}
public function edit($id){

    $countries = countries();    
    $keys = array_keys($countries);
    $receptionists=User::all();
    
    return view('receptionists.edit',['receptionist'=> User::findOrFail($id),
    'receptionists'=>$receptionists,
    'countries'=>$countries,
    'keys'=>$keys,
    ]);
}
public function update(Request  $request,$id)
{
    $this->validate(request(), [
        'id' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6',
        'image' => 'image|mimes:jpg,jpeg'
    ]);
    
    if($request->image == null){
        $destinationPath = 'img/avatar.jpg';
    }
    else{
    $file = $request->file('image');
    $fileName = $file->getClientOriginalName();
    $extension =  pathinfo($fileName);
    $fileName = $request->id.'.'.$extension["extension"];
    $destinationPath = 'img/'.$fileName;
    $file->move(public_path().'/img/',$fileName);
    }
    User::where('id',$id)->update([
        'id' => $request->id,
        'name' => $request->name,
        'type' => "3",
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'image' => $destinationPath,
        'mobile' => $request->mobile,
        'country' => $request->country,
        'gender' => $request->gender
    ]);
    return redirect(route('receptionists'));
}
}
 
