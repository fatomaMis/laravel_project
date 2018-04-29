<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Floor;
use App\User;


class FloorController extends Controller
{
    
public function index(){

$floors= Floor::all();
return view('floors.index');


}



public function create(){

return view ('floors.create');


}



public function store (Request $request){


    Floor::create([
        'name' => $request->name,
        'number' => rand(1000,100000),
        'managed_by' => $request->managed_by,
    ]);
    
   return redirect(route('floor.index', ['floors'=>$floors])); 
}




public function edit ($num){

    $floor=Floor::find($num);
    $users = User::all();
    return view('floors.edit',[
        'floor' => $floor,
        'users' => $users
    ]);

}


public function update(Request $request,Floor $floor)
{
   
   
    $new_floor = $request->only(['name', 'num']);
    $floor->update($new_floor);
    
   return redirect('/floors'); 
    
}



public function destroy(Floor $floor)
{
   $floor->delete();
    
    return redirect(route('floors.index'));
}







}














