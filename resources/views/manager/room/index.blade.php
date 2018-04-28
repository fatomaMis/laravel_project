@extends('layouts.client')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Manager</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      </nav>

  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Manage</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{ route('manageroom') }}">
          <span>Manage Receptionist</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
          <a href="{{ route('managefloor') }}">
          <span>Manage Floor </span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
          <a href="{{ route('managefloor') }}">
          <span>Manage Room</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
          <a href="/logout">
          <span>Logout</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
    </section>
    
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
@section('content')

<h1>
        Manager <b>Hello {{$clientData['name']}}</b>
        <small>Control panel</small>
      </h1>
      <center>
      <div class="col-sm-4">
      <a href="{{route('manageroom.create')}}" class="btn btn-success" data-toggle="modal"> <span>Add New Room</span></a>
      </div>
      </center>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Manager</li>
      </ol>

    <table class="table table-bordered" id="managers-table">
        <thead>
            <tr>
                <th>Number</th>
                <th>Capacity</th>
                <th>Price</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>

$(function() {
  var i = 0;
    $('#managers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('manageroom.data') !!}',
        columns: [
            { data: 'number', name: 'number' },
            { data: 'capacity', name: 'capacity'},
            { data: 'price', name: 'price'},
            {data: 'action', name: 'action', orderable: false, searchable: false,
                render: function (data, type, row) {
                  var id = row['id'];
                 
                  var manager_room =  '{{$clientData['id']}}';
                  var rooms = '{{$room}}'
                  room = JSON.parse(rooms.replace(/&quot;/g,'"'));
                  if (room[i]['manager_id'] == manager_room){
                  var url = '{{ route("manageroom.show", ":id") }}';
                  url = url.replace(':id', row['id']);

                  var editurl = '{{ route("manageroom.edit", ":id") }}';
                  editurl = editurl.replace(':id', row['id']);
                  
                    var linkView='<a href = "'+url+'" class="editor_preview btn btn-success btn-sm glyphicon glyphicon-th-list" data-id="' + row["id"] + '">VIEW</a>';
                    var linkEdit='<a href= "'+editurl+'" class="btn btn-warning btn-sm glyphicon glyphicon-edit" data-id="' + row['id'] + '">EDIT</a>';
                    var linkDelete='<button onclick="myFunction('+row['id']+')" class="deleteProduct btn btn-danger btn-sm glyphicon glyphicon-trash" data-id="' + row["id"] + '">DELETE</button>';
                    
                    return  linkView +' '+ linkEdit +' '+ linkDelete;
               }
               else{
                return null;
               }
               i++;
                }

            },
        ]
    });
});
function myFunction(id){
  var check = confirm("are you sure")
  if (check == true){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax(
    {
        url: "room/"+id,
        type: 'delete',
        dataType: "JSON",
        data: {
            "id": id 
        },
        success: function (response)
        {
    
          var table = $('#managers-table').DataTable();
          table.row( $(this).parents('tr') ).remove().draw();
            console.log(response);
        },
        error: function(xhr) {
         console.log(xhr.responseText);
       }
    });
}
};
</script>
@endpush

          