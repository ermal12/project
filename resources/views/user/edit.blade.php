@extends('layouts.admin.user')

@section('content')
<div class="content-wrapper">
	@include('includes.form-error')


	<section class="content-header">
		<h1>
			 User Profile
		</h1>


		<div class="col-sm-3">
	<img src="{{$user->photo ? $user->photo->file : 'User has no photo'}}" alt"" class="img-responsive img-rounded">
	</div>

		<div class="col-sm-9">


	{!! Form::model($user,['method'=>'PATCH','action'=>['UsersController@update',$user->id],'files'=> true]) !!}

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



<!-- 		<div class="form-group">
		{!! Form::label('role_id','Role:') !!}
		{!! Form::select ('role_id', $roles , null, ['class'=>'form-control'])!!}
	</div> -->






		<div class="form-group">
		{!! Form::submit('Update User',['class'=>'btn btn-primary col-sm-6']) !!}
		</div>




	{!! Form::close() !!}





	{!! Form::open(['method'=>'DELETE','action'=>['UsersController@destroy',$user->id]]) !!}


<div class="form-group">
		{!! Form::submit('Delete User',['class'=>'btn btn-danger col-sm-6']) !!}
		</div>




	{!! Form::close() !!}

</div>
</div>




@stop
