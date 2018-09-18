@extends('layouts.app')
@section('content')


	<div class="col-sm-6">


			@if($departments)
		<table class="table">
			<thead>
			<tr>
				<th>DepartmentName</th>
				<th>Created</th>
				<th>Edit</th>
			</tr>
			</thead>
			@foreach($departments as $department)
			<tr>
				<td>{{$department->name}}</td>
        <td>{{$department->created_at ? $department->created_at->diffForHumans() : 'no data'}}</td>
        <td><a href="{{route('department.edit',$department->id)}}"><i class="fa fa-edit"></i></a></td>
			</tr>
			@endforeach
		</table>
		@endif

	</div>






  @stop
