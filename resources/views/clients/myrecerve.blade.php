<h1>MY Recervation</h1>
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
    <th>Accompany Number</th>
    <th>Price</th>
  </tr>
</thead>
<tbody>  

@foreach($reservations as $reservation)
  
  <tr>
  <td>{{$reservation->room_id}}</td>
  <td>{{$reservation->accompany_number}}</td>
  <td>{{$reservation->price/100}}$</td>

  </tr>  
@endforeach 

</tbody>
</table>

</body>
</html>
