@extends('layouts.room')

@section('room')
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
<form class="form-horizontal" method="post" action="/manage/room" enctype="multipart/form-data">
{{csrf_field()}}
<table class="table table-bordered" id="managers-table">
          
<td>Room Number</td>
            <td><input type="number" name="num"></td>
            </tr>
            <tr>
            <td>Capacity</td>
            <td><input type="text" name="capacity"></td>
            </tr>
            <tr>
            <td>Price</td>
            <td><input type="text" name="price"></td>
            </tr>
            <tr>
            <td>Floor Id</td>
            <td>
  
         @for($i=0;$i<count($floors);$i++)
       <input type="checkbox" name="floorid" value="{{$floors[$i]->id}}" id={{$i}} />{{$floors[$i]->id}}
       <br>
       @endfor
       </td>
      
            </tr>
      <tr>
      <td>
Reserved
      </td>

      <td>
      <input type="checkbox" name="reserved" value="0"/>no
      <br>
      <input type="checkbox" name="reserved" value="1" checked/>yes
      </td>

      </tr>
            <input type="hidden" name="id" value="{{$clientData['id']}}">
    </table>
<input type="submit" value="Submit" class="btn btn-primary">
</form>
</div>
</div>
<script>
document.getElementById('0').setAttribute("checked", "checked");
</script>
@endsection




    
