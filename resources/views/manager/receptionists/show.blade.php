@extends('layouts.manager')

@section('manager')

<div class="container">
        <div class="table-wrapper">         

            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Receptionist Info</th>   
            <th style="background-color:#D3D3D3;width:740.25px">Details</th>      
                <tr><td><b>Name </b></td><td style="width:740.25px">{{$receptionist ->name}}</td></tr>
                <tr><td><b>Email </b></td><td style="width:740.25px">{{$receptionist->email}}</td></tr>
                <tr><td><b>Image </b></td><td style="width:740.25px"><img style = "height:100px" src= {{ url($receptionist->image)}}/></td></tr>
                <tr><td><b>Mobile </b></td><td style="width:740.25px">{{$receptionist->mobile}}</td></tr>
              
                <tr><td><b>Gender </b></td><td style="width:740.25px">{{$receptionist->gender}}</td></tr>
            </table>
        </div>
    </div>
@endsection

