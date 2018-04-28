<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Floor;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogFloor;
use \Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\Input;
use Storage;
use Session;

class floorController extends Controller
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
        else if($clientData['type']==2){
        $floors =  Floor::all();
        return view('manager.floor.index',[
            'floor' => $floors,
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
        $floor = Floor::all();
        return Datatables::of($floor)->addColumn('action', function ($floor) {
        })->make(true);
    }
    public function create(){
        $clientData=Session::get('loggedInUser');
        $floors=Floor::all();
        
        return view('manager.floor.create',[
            'floors'=>$floors,
            'clientData'=>$clientData
        ]);
    }
    public function store(StoreBlogFloor $request)
    {  
    
        Floor::create([
            'name'=>$request->name,
            'number'=>rand(1000,100000),
            'manager_id'=>$request->id,
        ]);
       return redirect(route('managefloor.store')); 
}
public function destroy($id)
{
    Floor::destroy($id);
    return response()->json([
        'success' => 'Record has been deleted successfully!'
    ]);
}
public function edit($id){
    $clientData=Session::get('loggedInUser');  
    
    return view('manager.floor.edit',['floor'=> Floor::findOrFail($id),
    'clientData' =>$clientData,
    ]);
}
public function update(Request  $request,$id)
{
    $this->validate(request(), [
        'name' => 'min:4',
    ]);
    Floor::where('id',$id)->update([
        'name'=>$request->name,
    ]);
    return redirect(route('managefloor'));
}
public function show($id){
    $clientData=Session::get('loggedInUser');

    return view('manager.floor.show', ['floor' => Floor::findOrFail($id),
                                   'clientData' =>$clientData,
    ]); 
}
}
