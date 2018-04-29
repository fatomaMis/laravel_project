@extends('layouts.manager')

@section('manager')
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

<form class="form-horizontal" method="post" action="{{route('managers.update',$manager->id)}}" enctype="multipart/form-data">
{{csrf_field()}}
<table class="table table-bordered" id="managers-table">
            <tr>
            <td>ID</td>
            <td><input type="text" name="id" value="{{$manager->id}}"></td>
            </tr>
            <tr>
            <td>Name</td>
            <td><input type="text" name="name" value="{{$manager->name}}"></td>
            </tr>
            <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="{{$manager->email}}" ></td>
            </tr>
            <tr>
            <td>Password</td>
            <td><input type="password" name="password" value="{{$manager->password}}"></td>
            </tr>
            <tr>
            <td>Image</td>
            <td><img src="../../{{$manager->image}}" style="height:80px"><input type="file"  class="form-control" name="image" id="image"></td>
            </tr> 
            <tr>
            <tr>
            <td>Mobile</td>
            <td><input type="text" name="mobile" value="{{$manager->mobile}}"></td>
            </tr>
            <tr>
            <td>Country</td>
            <td>
            <select id="country" class="form-control" name="country">
            @for ($i = 0; $i <= count($countries)-1; $i++)
            <option>{{$countries[$keys[$i]]["name"]}}</option>
            @endfor</select></td>
            </tr>
            <tr>
            <td>Gender</td>
            <td><select class="form-control" name="gender">
    <option value="female">female</option>
    <option value="male">male</option>
</select></td>
            </tr>
    </table>
<input type="submit" value="Update" class="btn btn-primary">
</form>
</div>
</div>
<script>
var id = document.getElementById("country");
id.value="{{$manager->country}}"
</script>
@endsection




    
