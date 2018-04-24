<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBlogUser;

class managersController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('managers.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $user=User::query();
        return Datatables::of($user)->addColumn('action', function ($user) {
        })->make(true);
    }

    public function create(){
        $managers=User::all();
        return view('managers.create',[
            'managers'=>$managers,
        ]);
    }
    
    public function store(StoreBlogUser $request)
    {
        User::create([
            'id' => $request->id,
            'name' => $request->name,
            'type' => "2",
            'email' => $request->email,
            'password' => $request->password,
            'image' => $request->image,
            'mobile' => $request->mobile,
            'country' => $request->country,
            'gender' => $request->gender
        ]);
       return redirect(route('managers.store')); 
}
}
