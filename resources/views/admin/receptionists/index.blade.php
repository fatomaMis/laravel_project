@extends('layouts.client')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
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
          <p>Admin</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{ route('adminmanagers') }}">
          <span>Manage Managers</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
          <a href="{{ route('adminreceptionists') }}">
          <span>Manage Receptionists</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li>
          <a href="{{ route('adminclients') }}">
          <span>Manage Clients</span>
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
        Admin <b>Hello {{$clientData['name']}}</b>
        <small>Control panel</small>
      </h1>
      <center>
      <div class="col-sm-4">
      <a href="{{route('adminreceptionists.create')}}" class="btn btn-success" data-toggle="modal"> <span>Add New Receptionist</span></a>
      </div>
      </center>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Admin</li>
      </ol>

    <table class="table table-bordered" id="receptionists-table">
        <thead>
            <tr>
            
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <th>Mobile</th>
                <th>Country</th>
                <th>Gender</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Managed By</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#receptionists-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('adminreceptionists.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email'},
            { data: 'image', name: 'image',
            render: function(data) {
                return "<center><img src=\"../" + data + "\" height=\"70\"/></center>";
        }
            },
            { data: 'mobile', name: 'mobile'},
            { data: 'country', name: 'country'},
            { data: 'gender', name: 'gender'},
            { data: 'created_at', name: 'created_at',
                render: function(data) {
                    if(!data){
                        return "time & date are unset yet";
                    }
                    var dateObj = new Date(data);
                    var month = dateObj.getUTCMonth() + 1; 
                    var day = dateObj.getUTCDate();
                    var year = dateObj.getUTCFullYear();

                    newdate = year + "/" + month + "/" + day;
                    return newdate;
                }
            },
            { data: 'updated_at', name: 'updated_at',
                render: function( data) {
                    if(!data){
                        return "not updated";
                    }
                    var dateObj = new Date(data);
                    var month = dateObj.getUTCMonth() + 1; 
                    var day = dateObj.getUTCDate();
                    var year = dateObj.getUTCFullYear();

                    newdate = year + "/" + month + "/" + day;
                    return newdate;
                 }
             },
             { data: 'manager', name: 'manager'},
            {data: 'action', name: 'action', orderable: false, searchable: false,
                render: function (data, type, row) {

                  var id = row['id'];
                  var url = '{{ route("adminreceptionists.show", ":id") }}';
                  url = url.replace(':id', row['id']);

                  var editurl = '{{ route("adminreceptionists.edit", ":id") }}';
                  editurl = editurl.replace(':id', row['id']);
                  
                    var linkView='<a href = "'+url+'" class="editor_preview btn btn-success btn-sm glyphicon glyphicon-th-list" data-id="' + row["id"] + '">VIEW</a>';
                    var linkEdit='<a href= "'+editurl+'" class="btn btn-warning btn-sm glyphicon glyphicon-edit" data-id="' + row['id'] + '">EDIT</a>';
                    var linkDelete='<button onclick="myFunction('+row['id']+')" class="deleteProduct btn btn-danger btn-sm glyphicon glyphicon-trash" data-id="' + row["id"] + '">DELETE</button>';
                    
                    return  linkView +' '+ linkEdit +' '+ linkDelete;
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
        url: "/admin/receptionists/"+id,
        type: 'delete',
        dataType: "JSON",
        data: {
            "id": id 
        },
        success: function (response)
        {
    
          var table = $('#receptionists-table').DataTable();
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

          