<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogUser;
use \Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\Input;
use Storage;

class managersController extends Controller
{
    
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    { 
        $managers = User::all();
        return view('managers.index',[
            'manager' => $managers
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
        $user= User::where('type', 2)->get();
        return Datatables::of($user)->addColumn('action', function ($user) {
        })->make(true);
    }

    public function create(){
        $countries = countries();    
        $keys = array_keys($countries);
        $managers=User::all();
        
        return view('managers.create',[
            'managers'=>$managers,
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
            'type' => "2",
            'email' => $request->email,
            'password' => $request->password,
            'image' => $destinationPath,
            'mobile' => $request->mobile,
            'country' => $request->country,
            'gender' => $request->gender
        ]);
       return redirect(route('managers.store')); 
}

public function show($id){
    $managers = User::all();
    $receptionists = $managers->where('manage_receptionist' ,'=', $id)
    ->where('type', '=', 3);
    foreach ($receptionists as $receptionist){
       $receptionist_id[] = $receptionist->id;
    }

    foreach ($receptionist_id as $rec_id){
        $receptionist = User::find($rec_id);
        $array[] = $receptionist;
     }
    return view('managers.show', ['manager' => User::findOrFail($id),
                                   'receptionist' => $array
    ]); 
}
}


