@extends('layouts.app')
@section('content')

<!DOCTYPE html>

<html>
<head>


</head>
<body>


<div class="container">
  <table id="departments" class="table table-hover table-condensed" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Department</th>
            <th>Description</th>
            <th>Edit Department</th>            


        </tr>
    </thead>
  </table>
     <button class="btn btn-basic"><a href="/department/create">Create Department</a></button>
<!--         <div class="form-group">
            {!! Form::submit('Create Department',['class'=>'btn btn-primary col-sm-3']) !!}
        </div> -->

</div>


<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#departments').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('index.getdepartments') }}",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},             
            {data: 'description', name: 'description'},           
            {data: 'action', name: 'action', orderable: false, searchable: false}
 



        ]
    });
});
</script>
</body>
</html>
@stop