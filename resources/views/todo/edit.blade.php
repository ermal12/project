@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">


  <section class="content-header">
		<h1>
			Edit Todo
		</h1>

		@include('includes.form-error')



			<div class="col-sm-9">


				{!! Form::model($todo,['method'=>'PATCH','action'=>['AdminTodo@update',$todo->id],'files'=> true]) !!}

				{{csrf_field()}}


				<div class="form-group">
					{!! Form::label('body','Body:') !!}
					{!! Form::text ('body',null,['class'=>'form-control'])!!}
				</div>






				<div class="form-group">
					{!! Form::submit('Update User',['class'=>'btn btn-primary col-sm-6']) !!}
				</div>




				{!! Form::close() !!}





				{!! Form::open(['method'=>'DELETE','action'=>['AdminTodo@destroy',$todo->id]]) !!}


				<div class="form-group">
					{!! Form::submit('Delete User',['class'=>'btn btn-danger col-sm-6']) !!}
				</div>




				{!! Form::close() !!}
@endsection
