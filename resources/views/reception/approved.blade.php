<h1>Un Approved Client<h1>
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
    <th>Client Name</th>
    <th>Client Emale</th> 
    <th>Client Phone</th>  
    <th>Client Country</th>  
    <th>Client Gender</th>
  </tr>
</thead>
<tbody>  

@foreach($clients as $client)
    @if($client->is_approved)
  <tr>
    <td>{{$client->name}}</td>
    <td>{{$client->email}}</td>
    <td>{{$client->phone}}</td>
    <td>{{$client->Country}}</td>
    <td>{{$client->gender}}</td>
  </tr>
  @endif   
@endforeach 

</tbody>
</table>
