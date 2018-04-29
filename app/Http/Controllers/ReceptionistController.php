<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ReceptionistController extends Controller
{
    
public function __construct()
{
//$this->middleware('auth:user');

}


// public function datatable()
//     {   
        
//         $receptionists =User::role('receptionist')->select(['id', 'name', 'email','created_at','created_by','banned_at']);

//         return Datatables::of($receptionists)
//         ->addColumn('action', function ($receptionists) {

//             $receptionist=User::find($receptionists->id);
//             $manager=User::find($receptionists->created_by);
        
//             $loginname=Auth::user();
//             if(($loginname->name==$manager->name)||($loginname->hasRole('admin'))){
//                 $loginname="right";
//             }
//             return view('receptionists.action',['id'=>$receptionists->id,'ban'=>$loginname,'receptionist'=>$receptionist]);
           
            
            
//         })
//         ->addColumn('managername', function ($receptionists) {
                
          
//             $manager=User::find($receptionists->created_by);
//             $loginname=Auth::user();
//             if($loginname->hasRole('admin')){
//                 return view('receptionists.managername',['name'=>  $manager->name]);
//             }
            
            
//         })->make(true);
        
        
       
        
//     }







public function datatable()
    {   

        //$user= User::where('type', 3)->get();
        $user = User::role('receptionist')->get();
        return Datatables::of($user)->addColumn('action', function ($user) {

            
        })->make(true);
}



public function index()
{
return view('manager.receptionists.index');

}






public function create()
{
return view('manager.receptionists.create');

}


public function store(Request $request)
{
$file=$request->file('image');
if($file){

    $path= $file->store('public/img');

}
else{

    $path= "public/img/avatar.jpg";
}

$loginuser=Auth::user();

$receptionist = new User ;
$receptionist->name = $request->name;
$receptionist->email = $request->email;
$receptionist->id = $request->id;
$receptionist->password = bcrypt($request->password );
$receptionist->image = $path ;
$receptionist->manage_receptionist = $request->manage_receptionist ;
$receptionist->mobile = $request->mobile;
$receptionist->gender = $request->gender;
$receptionist->save();

//Auth::user()->id 


$receptionist->assignRole('receptionist');

return view ('manager.receptionists.index',['receptionist'=>$receptionist]);
}




public function show ($id){

$receptionist= User::where('id', '=' , $id)->get()->first();

return view ('manager.receptionists.show',[
    'receptionist'=>$receptionist,
]);
}



public function edit ($id){

    $receptionist= User::find($id);
    return view ('manager.receptionists.edit' , [
        'receptionist'=>$receptionist,
    ]);
    

}



public function update (Request $request ,$id){
    $file=$request->file('photo');
    $receptionist= User::find($id);

    if($file){

        $path= $file->store('public/img');
    }
    else{
    
        $path= "public/img/avatar.jpg";
    }


    $receptionist->update ([

        'name' => $request->name,
        'email' => $request->email,
        'id'=> $request->id,
        'password'=> Hash::make($request->password),
        'avatar'=>$path, 

    ]);
    
return redirect(route('receptionists'));

}


public function destroy($id){
    // dd($id);

//     $receptionist= User::find($id);
//   $receptionistAvatar = $receptionist->avatar;
//   Storage::delete($receptionistAvatar);
//    User::find($id)->delete();
//    return redirect(route('receptionists'));
User::destroy($id);
return json_encode(['success' => 'Record has been deleted successfully']);

}


public function ban($id){

    $receptionist= User::find($id);

 if (!$receptionist->isBanned()){

    $receptionist->ban();
 }
 else{
    $receptionist->unban();

 }


 return redirect(route('receptionists'));
}

}
