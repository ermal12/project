@extends('layouts.app')

@section('content')
<div class="container" >
	<h1>Edit Department</h1>


		

		<div class="col-sm-9">


	{!! Form::model($department,['method'=>'PATCH','action'=>['DepartmentController@update',$department->id]]) !!}

		{{csrf_field()}}


	<div class="form-group">
		{!! Form::label('name','Name:') !!}
		{!! Form::text ('name',null,['class'=>'form-control'])!!}
	</div>








		<div class="form-group">
		{!! Form::submit('Update Department',['class'=>'btn btn-primary col-sm-6']) !!}
		</div>




	{!! Form::close() !!}



	{!! Form::open(['method'=>'DELETE','action'=>['DepartmentController@destroy',$department->id]]) !!}


<div class="form-group">
		{!! Form::submit('Delete Department',['class'=>'btn btn-danger col-sm-6']) !!}
		</div>




	{!! Form::close() !!}



</div>




@stop