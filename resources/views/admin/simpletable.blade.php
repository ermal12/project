@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">


  <table class="table table-bordered" style="width:90%">
    <tr>
      <th>Name</th>
      <th>Role</th>
      <th>Username</th>
      <th>Department</th>
      <th>Created</th>
      <th>Updated</th>
      <th>View</th>
      <th>Delete</th>
    </tr>
    <tr>

      @if($users)
      @foreach($users as $user)


    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->role->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->department ? $user->department->name : 'User has no department'}}</td>
      <td>{{$user->created_at ? $user->created_at->diffForHumans() : 'no data'}}</td>
      <td>{{$user->updated_at ? $user->updated_at->diffForHumans() : 'no data'}}</td>
      <td><a href="{{route('admin.edit',$user->id)}}"><i class="fa fa-edit"></i></a></td>
      <td>{!! Form::open (['method'=>'DELETE','action'=>['AdminUsersController@destroy',$user->id]]) !!}

        <div class="form-group ">
          {!! Form::submit('Delete User',['class'=>'btn btn-danger col-sm-6=3 ']) !!}
        </div>


        {!! Form::close() !!}
      </td>

      @endforeach

      @endif
  </table>

  <div class="row">
    <div class="col-sm-5 col-sm-offset-4">
      {{ $users->links() }}

    </div>
  </div>
</div>

</div>

@stop
