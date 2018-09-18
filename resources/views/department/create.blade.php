@extends('layouts.app')

@section('content')
<div class="container" >

	<h1>Create Department</h1>


	{!! Form::open(['method'=>'POST','action'=>'DepartmentController@store']) !!}

	{{csrf_field()}}


	<div class="form-group">
		{!! Form::label('name','Name:') !!}
		{!! Form::text ('name',null,['class'=>'form-control'])!!}
	</div>




		<div class="form-group">
		{!! Form::submit('Create Department',['class'=>'btn btn-primary']) !!}
		</div>
</div>





	{!! Form::close() !!}




@stop
