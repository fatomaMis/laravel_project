@extends('layouts.master')


@section('content')

<div class="container">
        <div class="table-wrapper">         

            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Post Info</th>        
                <tr><td><b>Title </b>:-{{$post->title}}
                <br><b>Description </b>:-
                <br>{{$post->description}}</td></tr>
            </table>
            <table class="table table-bordered">
            <th style="background-color:#D3D3D3">Post Creator Info</th>        
                <tr><td><b>Name </b>:-{{$post->user->name}}
                <br><b>Email </b>:-{{$post->user->email}}
                
                <br><b>Created At </b>:-{{ $post->created_at->toDayDateTimeString() }}</td></tr>
            </table>
        </div>
    </div>
@endsection