@extends('layouts.room')

@section('room')

<div class="container">
        <div class="table-wrapper">         

            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Room Info</th>   
            <th style="background-color:#D3D3D3;width:740.25px">Details</th>      
                <tr><td><b>Number </b></td><td style="width:740.25px">{{$room->number}}</td></tr>
                <tr><td><b>Capacity </b></td><td style="width:740.25px">{{$room->capacity}}</td></tr>
                <tr><td><b>Price</b></td><td style="width:740.25px">{{$room->price}}</td></tr>
                <tr><td><b>floor name</b></td><td style="width:740.25px">{{$room->floor->name}}</td></tr>
            </table>
        </div>
    </div>
@endsection
