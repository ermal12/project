@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
	<title>Laravel Department Treeview Example</title>

    <link href="/css/treeview.css" rel="stylesheet">

</head>
<body>
	<div class="container">
			@include('includes.form-error')

			@if(session('department_created'))
		<h2 class="alert alert-success">
			{{session('department_created')}}
		</h2>
		@endif


			@if(session('department_deleted'))
		<h2 class="alert alert-success">
			{{session('department_deleted')}}
		</h2>
		@endif


		<div class="panel panel-primary">
			<div class="panel-heading">Manage Departments TreeView</div>
	  		<div class="panel-body">
	  			<div class="row">
	  				<div class="col-md-6">
	  					<h3>Department List</h3>
				        <ul id="tree1">
				          	@isset($parents)



	          					@foreach($parents as $parent)
	          						<li>{{$parent->name}}
	          						@if($parent->user->count())
      								<ul>
      									@foreach($parent->user as $userItem)
      									<li><h5>{{$userItem->name}}</h5></li>
      									@endforeach
      								</ul>
	          						@endif

	          						@if(subDepartments($parent->id)->count())
  										<ul>
		          							@foreach(subDepartments($parent->id) as $item)

		          								<li>{{$item->name}}

	          						@if($item->user->count())
      								<ul>
      									@foreach($item->user as $userItem)
      									<li><h5>{{$userItem->name}}</h5></li>
      									@endforeach
      								</ul>
	          						@endif


		          								@if(subDepartments($item->id)->count())
		          								<ul>
	      											@foreach(subDepartments($item->id) as $subItem)
	      											<li>{{$subItem->name}}


	          						@if($item->user->count())
      								<ul>
      									@foreach($subItem->user as $subItem)
      									<li><h5>{{$subItem->name}}</h5></li>
      									@endforeach
      								</ul>
	          						@endif


      													@if(subDepartments($subItem->id)->count())
      													<ul>
      														@foreach(subDepartments($subItem->id) as $subSubItem)
															<li>{{$subSubItem->name}}

	          						@if($subSubItem->user->count())
      								<ul>
      									@foreach($subSubItem->user as $subSubItem)
      									<li><h5>{{$subSubItem->name}}</h5></li>
      									@endforeach
      								</ul>
	          						@endif

      														@endforeach
      													</ul>
      													@endif


	      											</li>
	      											@endforeach
	      											</ul>
		          								@endif
	          								@endforeach

  										</ul>
  										@endif
	          						</li>

	          					@endforeach
				          	@endisset
				        </ul>
	  				</div>
	  				<div class="col-md-6">
	  					<h3>Add New Department</h3>



	  					{!! Form::open (['method'=>'POST','action'=>'DepartmentController@store'])!!}

	  						<div class="form-group ">
								{!! Form::label('name','Name:') !!}
								{!! Form::text ('name',null,['class'=>'form-control'])!!}
							</div>


								<div class="form-group">
							{!! Form::label('department_id','Department:') !!}
							{!! Form::select ('parent_id', [''=>'Choose Options'] + $departments, null, ['class'=>'form-control'])!!}
						</div>




								<div class="form-group col-sm-6">
								{!! Form::submit('Create Department',['class'=>'btn btn-primary']) !!}
								</div>



	  					{!! Form::close () !!}

							<a href="{{route('departments') }}" class="btn btn-info"> Edit Departments </a>


	  				</div>
	  			</div>


	  		</div>
        </div>
    </div>
    <script src="/js/treeview.js"></script>



</body>

</html>
@stop
