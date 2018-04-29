<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Client;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogFloor;
use \Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\Input;
use Storage;
use Session;
class receptionistsController extends Controller
{
    
    public function getIndex()
    { 
        $receptionists = User::where('type', 3)->get();
        $clientData=Session::get('loggedInUser');
        if($clientData == null){
            return view('login');
        }
        else if($clientData['type']==1){
        return view('admin.receptionists.index',[
            'receptionists' => $receptionists,
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
        $receptionists = User::where('type', 3)->get();
        $i=0;
        foreach ($receptionists as $receptionist)
            {
                $id[$i] = $receptionist->manage_receptionist;
                $i++;
            }
           
        return Datatables::of($receptionists)
        ->addColumn('action', function ($receptionists) {
        })
        ->make(true);
    }


    public function create(){
        $clientData=Session::get('loggedInUser');
        $countries = countries();    
        $keys = array_keys($countries);
        $receptionists=User::all();
        
        return view('admin.receptionists.create',[
            'receptionists'=>$receptionists,
            'countries'=>$countries,
            'keys'=>$keys,
            'clientData' =>$clientData,
        ]);
    }
    
    public function store(Request $request)
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
            'type' => "3",
            'email' => $request->email,
            'password' => $request->password,
            'image' => $destinationPath,
            'mobile' => $request->mobile,
            'country' => $request->country,
            'gender' => $request->gender,
            'receptionist_client' => $request->receptionist_client
        ]);
       return redirect(route('adminreceptionists.store')); 
}

public function show($id){
    $clientData=Session::get('loggedInUser');
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
    return view('admin.receptionists.show', ['receptionist' => User::findOrFail($id),
                                   'client' => $array,
                                   'clientData' =>$clientData,
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
    $clientData=Session::get('loggedInUser');
    $countries = countries();    
    $keys = array_keys($countries);
    $receptionists=User::all();
    
    return view('admin.receptionists.edit',['receptionist'=> User::findOrFail($id),
    'receptionists'=>$receptionists,
    'countries'=>$countries,
    'keys'=>$keys,
    'clientData' =>$clientData,
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
        'password' => $request->password,
        'image' => $destinationPath,
        'mobile' => $request->mobile,
        'country' => $request->country,
        'gender' => $request->gender,
        'receptionist_client' => $request->receptionist_client
    ]);
    return redirect(route('adminreceptionists'));
}
}
 
