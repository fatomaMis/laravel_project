<h1>Make Recevation<h1>

</<!DOCTYPE html>
<html>
<head>

</head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<body>
    
<table style="width:100%">
<thead>
  <tr>
    <th>Room Number</th> 
    <th>Capacity</th>
    <th>Price</th>
    <th>If You Want Make Recervation</th>
  </tr>
</thead>
<tbody>  

@foreach($rooms as $room)
    @if(!($room->is_reserved))
  <tr>
    <td>{{$room->room_number}}</td>
    <td>{{$room->capacity}}</td>
    <td>{{$room->price%100}}$</td>
    <td>
    <a href="{{route('showroom',$room->id)}}" class="btn btn-info btn-sm active" role="button">​Make Reservation</a>
    </td>
  </tr>
  @endif   
@endforeach 

</tbody>
</table>

</body>
</html>
