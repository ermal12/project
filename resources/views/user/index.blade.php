@extends('layouts.admin.user')

@section('content')

<div class="content-wrapper">
	@if(session('msg'))
	<h2 class="alert">
		{{session('msg')}}
	</h2>
	@endif
	<section class="content-header">
		<h1>
			 User Profile
		</h1>







@if(session('msg'))
<h2 class="alert">
	{{session('msg')}}
</h2>
@endif


  <table class="table">

	<th>Id</th>
	<th>Photo</th>
	<th>Name</th>
	<th>Email</th>
	<th>Role</th>
	<th>Updated</th>
	<th>Created</th>



	<tr>
		<td>{{$user->id}}</td>
		<td><img  width =100 height="70" src="{{$user->photo ? $user->photo->file :'User has no photo'}}"></td>
		<td><a href="{{route('user.edit',$user->id)}}">{{$user->name}}</a></td>
		<td>{{$user->email}}</td>
		<td>{{$user->role ? $user->role->name :'User has no role'}}</td>
        <td>{{$user->created_at->diffForHumans()}}</td>
        <td>{{$user->updated_at->diffForHumans()}}</td>



	</tr>

</table>
</div>
</div>



@endsection
