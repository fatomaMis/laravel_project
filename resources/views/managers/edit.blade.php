@extends('layouts.master')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
        <div class="table-wrapper">         

            <table class="table table-bordered">
            
<form method="post" action="{{route('posts.update',$post->id)}}">
{{csrf_field()}}
Title :- <input type="text" name="title" value="{{$post->title}}">
<br><br>
Description :- 
<textarea name="description">{{$post->description}}</textarea>
<br>
<br>
Post Creator :-
<br>
<select class="form-control" name="user_id">
@foreach ($users as $user)
    <option value="{{$user->id}}">{{$user->name}}</option>
@endforeach
</select>
<br>
<input type="submit" value="Update" class="btn btn-primary">
</form>
</table>
        </div>
    </div>  
@endsection