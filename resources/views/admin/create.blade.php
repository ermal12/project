@extends('layouts.app')

@section('content')
<div class="container" >
	<h1>Create Users</h1>
	@include('includes.form-error')

	{!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store','files'=> true]) !!}

		{{csrf_field()}}


	<div class="form-group">
		{!! Form::label('name','Name:') !!}
		{!! Form::text ('name',null,['class'=>'form-control'])!!}
	</div>



		<div class="form-group">
		{!! Form::label('email','Email:') !!}
		{!! Form::email ('email',null,['class'=>'form-control'])!!}
	</div>




<div class="form-group">
		{!! Form::label('password','Password:') !!}
		{!! Form::password ('password',['class'=>'form-control'])!!}
	</div>

		<div class="form-group">
		{!! Form::label('photo_id','File:') !!}
		{!! Form::file ('photo_id',null,['class'=>'form-control'])!!}
	</div>



		<div class="form-group">
		{!! Form::label('role_id','Role:') !!}
		{!! Form::select ('role_id', [''=>'Choose Options'] + $roles , null, ['class'=>'form-control'])!!}
	</div>





		<div class="form-group">
		{!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
		</div>
</div>





	{!! Form::close() !!}




@stop