@extends('layouts.app')
@section('content')

<!DOCTYPE html>

<html>
<head>


</head>
<body>



<div class="container">
  <table id="users" class="table table-hover table-condensed" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Department</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Edit User</th>            


        </tr>
    </thead>
  </table>
</div>


<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('index.getposts') }}",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'departments', name: 'departments',searchable: false},
            {data: 'name', name: 'name'},            
            {data: 'email', name: 'email'},   
            {data: 'updated_at', name: 'updated_at'},
            {data: 'created_at', name: 'created_at'},              
            {data: 'action', name: 'action', orderable: false, searchable: false}
 



        ]
    });
});
</script>
</body>
</html>
@stop