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
    <th>Approved Clients </th>
  </tr>
</thead>
<tbody>  

@foreach($clients as $client) 
    @if(!($client->is_approved))
  <tr>
    <td>{{$client->name}}</td>
    <td>
        <form action="{{ url('/unapproved') }}">
            <input type="submit" value="Approved" />
        </form>
    </td>
  </tr>
  @endif   
@endforeach

</tbody>
</table>
