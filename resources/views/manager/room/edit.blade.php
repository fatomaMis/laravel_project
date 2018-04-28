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

<form class="form-horizontal" method="post" action="{{route('managefloor.update',$floor->id)}}" enctype="multipart/form-data">
{{csrf_field()}}
<table class="table table-bordered" id="managers-table">

            <td>Name</td>
            <td><input type="text" name="name" value="{{$floor->name}}"></td>
            </tr>
            <tr>
            <td>Number</td>
            <td><input type="number" name="number" value="{{$floor->number}}" ></td>
            </tr>

    </table>
<input type="submit" value="Update" class="btn btn-primary">
</form>
</div>
</div>
@endsection




    
