@extends('layouts.manager')

@section('manager')

<div class="container">
        <div class="table-wrapper">         

            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Manager Info</th>   
            <th style="background-color:#D3D3D3;width:740.25px">Details</th>      
                <tr><td><b>Name </b></td><td style="width:740.25px">{{$manager->name}}</td></tr>
                <tr><td><b>Email </b></td><td style="width:740.25px">{{$manager->email}}</td></tr>
                <tr><td><b>Image </b></td><td style="width:740.25px"><img style = "height:100px" src= ../../{{$manager->image}}/></td></tr>
                <tr><td><b>Mobile </b></td><td style="width:740.25px">{{$manager->mobile}}</td></tr>
                <tr><td><b>Country </b></td><td style="width:740.25px">{{$manager->country}}</td></tr>
                <tr><td><b>Gender </b></td><td style="width:740.25px">{{$manager->gender}}</td></tr>
            </table>
            @foreach ($receptionist as $rec)
            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Manage Receptionist</th>   
            <th style="background-color:#D3D3D3;width:740.25px;">Of ID {{$rec->id}}</th>      
                <tr><td><b>Name </b></td><td style="width:740.25px">{{$rec->name}}</td></tr>
                <tr><td><b>Email </b></td><td style="width:740.25px">{{$rec->email}}</td></tr>
                <tr><td><b>Image </b></td><td style="width:740.25px"><img style = "height:100px" src= ../../{{$rec->image}}/></td></tr>
                <tr><td><b>Mobile </b></td><td style="width:740.25px">{{$rec->mobile}}</td></tr>
                <tr><td><b>Country </b></td><td style="width:740.25px">{{$rec->country}}</td></tr>
                <tr><td><b>Gender </b></td><td style="width:740.25px">{{$rec->gender}}</td></tr>
            </table>
            @endforeach
        </div>
    </div>
@endsection
