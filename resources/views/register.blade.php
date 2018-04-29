 
@extends('layouts.app')
 
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
     
     <form method="post" action="/register" style="padding-left:100px;width:900px">
         {{ csrf_field() }}
         <h2>Register</h2>
         <div class="form-group">
             <label for="name">Name:</label>
             <input type="text" class="form-control" id="name" name="name">
         </div>
         <div class="form-group">
             <label for="email">Email:</label>
             <input type="email" class="form-control" id="email" name="email">
         </div>
         <div class="form-group">
             <label for="phone">Phone:</label>
             <input type="text" class="form-control" id="phone" name="phone">
         </div>
         <div class="form-group">
             <label for="gender">Gender:</label>
             <select class="form-control" name="gender">
    <option value="female">female</option>
    <option value="male">male</option>
    </select>
         </div>
         <div class="form-group">
             <label for="country">Country:</label>
             <select class="form-control" name="country">
            @for ($i = 0; $i <= count($countries)-1; $i++)
            <option>{{$countries[$keys[$i]]["name"]}}</option>
            @endfor</select>
         </div>
         <div class="form-group">
             <label for="avatar_image">Image:</label>
             <input type="file" class="form-control" name="avatar_image" id="avatar_image">
         </div>
         <div class="form-group">
             <label for="password">Password:</label>
             <input type="password" class="form-control" id="password" name="password">
         </div>
  
         <div class="form-group">
             <button style="cursor:pointer" type="submit" class="btn btn-primary">Register</button>
         </div>
 
     </form>
 
 @endsection