@extends('layouts.manager')

@section('manager')

<div class="container">
        <div class="table-wrapper">         

            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Manager Info</th>   
            <th style="background-color:#D3D3D3;width:740.25px">Details</th>      
                <tr><td><b>Name </b></td><td style="width:740.25px">{{$receptionist->name}}</td></tr>
                <tr><td><b>Email </b></td><td style="width:740.25px">{{$receptionist->email}}</td></tr>
                <tr><td><b>Image </b></td><td style="width:740.25px"><img style = "height:100px" src= ../../../{{$receptionist->image}}/></td></tr>
                <tr><td><b>Mobile </b></td><td style="width:740.25px">{{$receptionist->mobile}}</td></tr>
                <tr><td><b>Country </b></td><td style="width:740.25px">{{$receptionist->country}}</td></tr>
                <tr><td><b>Gender </b></td><td style="width:740.25px">{{$receptionist->gender}}</td></tr>
            </table>
            @foreach ($client as $cl)
            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Manage Receptionist</th>   
            <th style="background-color:#D3D3D3;width:740.25px;">Of ID {{$cl->id}}</th>      
                <tr><td><b>Name </b></td><td style="width:740.25px">{{$cl->name}}</td></tr>
                <tr><td><b>Email </b></td><td style="width:740.25px">{{$cl->email}}</td></tr>
                <tr><td><b>Image </b></td><td style="width:740.25px"><img style = "height:100px" src= ../../../{{$cl->image}}/></td></tr>
                <tr><td><b>Mobile </b></td><td style="width:740.25px">{{$cl->mobile}}</td></tr>
                <tr><td><b>Country </b></td><td style="width:740.25px">{{$cl->country}}</td></tr>
                <tr><td><b>Gender </b></td><td style="width:740.25px">{{$cl->gender}}</td></tr>
            </table>
            @endforeach
        </div>
    </div>
@endsection
