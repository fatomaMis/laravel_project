@extends('layouts.manager')

@section('manager')

<div class="container">
        <div class="table-wrapper">         

            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Manager Info</th>   
            <th style="background-color:#D3D3D3;width:740.25px">Details</th>      
                <tr><td><b>Name </b></td><td style="width:740.25px">{{$client->name}}</td></tr>
                <tr><td><b>Email </b></td><td style="width:740.25px">{{$client->email}}</td></tr>
                <tr><td><b>Image </b></td><td style="width:740.25px"><img style = "height:100px" src= ../../../{{$client->avatar_image}}/></td></tr>
                <tr><td><b>Country </b></td><td style="width:740.25px">{{$client->countries}}</td></tr>
                <tr><td><b>Gender </b></td><td style="width:740.25px">{{$client->gender}}</td></tr>
            </table>
           
        </div>
    </div>
@endsection
