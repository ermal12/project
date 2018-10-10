@extends('layouts.admin.app')
@section('content')

<div class="content-wrapper">
<div class="col-sm-6">


	@if($departments)
	<table class="table">
		<thead>
			<tr>
				<th>DepartmentName</th>
				<th>Created</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		@foreach($departments as $department)
		<tr>
			<td>{{$department->name}}</td>
			<td>{{$department->created_at ? $department->created_at->diffForHumans() : 'no data'}}</td>
			<td><a href="{{route('department.edit',$department->id)}}"><i class="fa fa-edit"></i></a></td>
			<td>{!! Form::open (['method'=>'DELETE','action'=>['DepartmentController@destroy',$department->id]]) !!}

        <div class="form-group ">
          {!! Form::submit('Delete User',['class'=>'btn btn-danger col-sm-6=3 ']) !!}
        </div>


        {!! Form::close() !!}
      </td>
		</tr>
		@endforeach
	</table>
	@endif

</div>

</div>




@stop
