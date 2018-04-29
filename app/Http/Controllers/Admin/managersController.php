<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogUser;
use \Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\Input;
use Storage;
use Session;

class managersController extends Controller
{
    
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    { 
        
        $clientData=Session::get('loggedInUser');
        if($clientData == null){
            return view('login');
        }
        else if($clientData['type']==1){
        $managers =  User::where('type', 2)->get();;
        return view('admin.managers.index',[
            'manager' => $managers,
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
        //$user=User::query();
        $user= User::where('type', 2)->get();
        return Datatables::of($user)->addColumn('action', function ($user) {
        })->make(true);
    }

    public function create(){
        $clientData=Session::get('loggedInUser');
        $countries = countries();    
        $keys = array_keys($countries);
        $managers=User::all();
        
        return view('admin.managers.create',[
            'managers'=>$managers,
            'countries'=>$countries,
            'keys'=>$keys,
            'clientData' =>$clientData,
        ]);
    }
    
    public function store(StoreBlogUser $request)
    {  
        if($request->image == null){
            $destinationPath = '../img/avatar.jpg';
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
            'gender' => $request->gender,
            'manage_receptionist' => $request->manage_receptionist
        ]);
       return redirect(route('adminmanagers.store')); 
}

public function show($id){
    $clientData=Session::get('loggedInUser');
    $managers = User::all();
    $receptionist_id = [];
    $array = [];
    $receptionists = $managers->where('manage_receptionist' ,'=', $id)
    ->where('type', '=', 3);
    foreach ($receptionists as $receptionist){
       $receptionist_id[] = $receptionist->id;
    }

    foreach ($receptionist_id as $rec_id){
        $receptionist = User::find($rec_id);
        $array[] = $receptionist;
     }
    return view('admin.managers.show', ['manager' => User::findOrFail($id),
                                   'receptionist' => $array,
                                   'clientData' =>$clientData,
    ]); 
}

public function stat()
{
    //stat here
    return view('admin.managers.stat',[
            // 'manager' => $managers
        ]);
}
public function destroy($id)
{
    $receptionists_id = User::find($id);
        $rec_id = $receptionists_id->manage_receptionist;
        User::whereIn('id', [$id,$rec_id])->delete();
    return response()->json([
        'success' => 'Record has been deleted successfully!'
    ]);
}
public function edit($id){
    $clientData=Session::get('loggedInUser');
    $countries = countries();    
    $keys = array_keys($countries);
    $managers=User::all();
    
    return view('admin.managers.edit',['manager'=> User::findOrFail($id),
    'managers'=>$managers,
    'countries'=>$countries,
    'keys'=>$keys,
    'clientData' =>$clientData,
    ]);
}
public function update(Request $request,$id)
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
        'type' => "2",
        'email' => $request->email,
        'password' => $request->password,
        'image' => $destinationPath,
        'mobile' => $request->mobile,
        'country' => $request->country,
        'gender' => $request->gender,
        'manage_receptionist' => $request->manage_receptionist
    ]);
    return redirect(route('adminmanagers'));
}
}
