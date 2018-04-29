@extends('layouts.floor')

@section('floor')

<div class="container">
        <div class="table-wrapper">         

            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Floor Info</th>   
            <th style="background-color:#D3D3D3;width:740.25px">Details</th>      
                <tr><td><b>Name </b></td><td style="width:740.25px">{{$floor->name}}</td></tr>
                <tr><td><b>Number </b></td><td style="width:740.25px">{{$floor->number}}</td></tr>
                <tr><td><b>Manager_id </b></td><td style="width:740.25px">{{$floor->manager_id}}</td></tr>
            </table>
        </div>
    </div>
@endsection
