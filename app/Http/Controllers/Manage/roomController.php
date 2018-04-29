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
        $rooms = Room::all();
        $i=0;
        foreach ($rooms as $room){
           $array[$i]=$room;
            $i++;
        }
        for ($i=0;$i<count($rooms);$i++){
            Room::where('id',$array[$i]->id)->update(['id'=>($i+1)]);
        }

        $clientData=Session::get('loggedInUser');
        if($clientData == null){
            return view('login');
        }
        else if($clientData['type']==2){
        $rooms =  Room::all();
        $num = Room::all()->first();
        if($num){
        $num = $num->id;
        return view('manager.room.index',[
            'room' => $rooms,
            'clientData' => $clientData,
            'num' => $num
        ]);
        }
        else{
            return view('manager.room.index',[
                'room' => $rooms,
                'clientData' => $clientData,
                'num' => '1'
            ]);
        }
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
        return Datatables::of($room)
        ->addColumn('floorname', function ($room) {
            return $room->floor->name;
        })
        ->addColumn('action', function ($room) {})

        ->make(true);
    }
    public function create(){
        $clientData=Session::get('loggedInUser');
        $rooms=Room::all();
        $floors = Floor::all();
        return view('manager.room.create',[
            'room'=>$rooms,
            'clientData'=>$clientData,
            'floors'=>$floors
        ]);
    }
    public function store(StoreBlogRoom $request)
    {  
        Room::create([
            'number'=>$request->num,
            'capacity'=>$request->capacity,
            'price'=>$request->price,
            'manager_id'=>$request->id,
            'floor_id'=>$request->floorid,
            'is_admin'=>'0',
            'is_reserved'=>$request->reserved
        ]);
       return redirect(route('manageroom.store')); 
}
public function destroy($id)
{
  
    Room::destroy($id);
    $rooms = Room::all();
    $i=0;
    foreach ($rooms as $room){
       $array[$i]=$room;
        $i++;
    }
    for ($i=0;$i<count($rooms);$i++){
        Room::where('id',$array[$i]->id)->update(['id'=>($i+1)]);
    }
    return response()->json([
        'success' => 'Record has been deleted successfully!'
    ]);
}
public function edit($id){
    $clientData=Session::get('loggedInUser');  
    $floors = Floor::all();
    return view('manager.room.edit',['room'=> Room::findOrFail($id),
    'clientData' =>$clientData,
    'floors'=>$floors
    ]);
}
public function update(Request  $request,$id)
{
    $this->validate(request(), [
        'number' => 'min:4',
        'capacity' => 'integer',
        'price' => 'numeric',
        'is_admin'=>'0',
        'is_reserved'=>$request->reserved
    ]);
    Room::where('id',$id)->update([
        'number'=>$request->num,
        'capacity'=>$request->capacity,
        'price'=>$request->price,
        'manager_id'=>$request->id,
        'floor_id'=>$request->floorid,
        'is_admin'=>'0',
        'is_reserved'=>$request->reserved
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
