<?php

namespace App\Http\Controllers\Manage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Room;
use App\Floor;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogRoom;
use \Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\Input;
use Storage;
use Session;

class roomController extends Controller
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
        $rooms =  Room::all();
        return view('manager.room.index',[
            'room' => $rooms,
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
        $room = Room::all();
        return Datatables::of($room)->addColumn('action', function ($room) {
        })->make(true);
    }
    public function create(){
        $clientData=Session::get('loggedInUser');
        $rooms=Room::all();
        return view('manager.room.create',[
            'rooms'=>$rooms,
            'clientData'=>$clientData
        ]);
    }
    public function store(StoreBlogRoom $request)
    {  
        Room::create([
            'number'=>$request->number,
            'capacity'=>$request->capacity,
            'price'=>$request->price,
        ]);
       return redirect(route('manageroom.store')); 
}
public function destroy($id)
{
    Room::destroy($id);
    return response()->json([
        'success' => 'Record has been deleted successfully!'
    ]);
}
public function edit($id){
    $clientData=Session::get('loggedInUser');  
    
    return view('manager.room.edit',['room'=> Room::findOrFail($id),
    'clientData' =>$clientData,
    ]);
}
public function update(Request  $request,$id)
{
    $this->validate(request(), [
        'name' => 'min:4',
    ]);
    Room::where('id',$id)->update([
        'name'=>$request->name,
    ]);
    return redirect(route('manageroom'));
}
public function show($id){
    $clientData=Session::get('loggedInUser');

    return view('manager.room.show', ['room' => Room::findOrFail($id),
                                   'clientData' =>$clientData,
    ]); 
}
}
