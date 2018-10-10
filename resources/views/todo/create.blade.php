@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">

<div class="container">
  		{!! Form::open(['method'=>'POST','action'=>'AdminTodo@store']) !!}

  		{{csrf_field()}}
      
      @include('includes.form-error')


  		<div class="form-group col-sm-6">
  			{!! Form::label('name','Name:') !!}
  			{!! Form::text ('body',null,['class'=>'form-control'])!!}
  		</div>

<br>






  		<div class="form-group col-sm-7">
  			{!! Form::submit('Create Todo',['class'=>'btn btn-primary']) !!}
  		</div>
  </div>





  {!! Form::close() !!}
</div>
</div>
@endsection
