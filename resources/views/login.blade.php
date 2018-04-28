@extends('layouts.app')
 
@section('content')  
    
    <form method="POST" action="/login/loginUser" style="padding-left:100px;width:900px">
        {{ csrf_field() }}
        <h2>Log In</h2>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
 
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
 
        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Login</button>
        </div>

    </form>

@endsection