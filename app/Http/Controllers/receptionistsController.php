<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogUser;
use \Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\Input;
use Storage;

class receptionistsController extends Controller
{
    
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    { 
        $receptionists = User::where('type', 3)->get();
        
        return view('receptionists.index',[
            'receptionists' => $receptionists
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
        $receptionists = User::where('type', 3)->get();
        $i=0;
        foreach ($receptionists as $receptionist)
            {
                $id[$i] = $receptionist->manage_receptionist;
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
        
        return view('receptionists.create',[
            'receptionists'=>$receptionists,
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
        User::create([
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
       return redirect(route('receptionists.store')); 
}

public function show($id){
    $receptionists = User::all();
    $client_id = [];
    $array = [];
    $clients = $receptionists->where('receptionist_client' ,'=', $id)
    ->where('type', '=', 4);
    foreach ($clients as $client){
       $client_id[] = $client->id;
    }

    foreach ($client_id as $cl_id){
        $client = User::find($cl_id);
        $array[] = $client;
     }
    return view('receptionists.show', ['receptionist' => User::findOrFail($id),
                                   'client' => $array
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
 
