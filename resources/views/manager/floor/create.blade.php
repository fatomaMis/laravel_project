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
<form class="form-horizontal" method="post" action="/manage/floor" enctype="multipart/form-data">
{{csrf_field()}}
<table class="table table-bordered" id="managers-table">
            <tr>
            <td>Name</td>
            <td><input type="name" name="name"></td>
            </tr>
            <tr>
            
       <input type="hidden" name="id" value="{{$clientData['id']}}">

    </table>
<input type="submit" value="Submit" class="btn btn-primary">
</form>
</div>
</div>
@endsection




    
