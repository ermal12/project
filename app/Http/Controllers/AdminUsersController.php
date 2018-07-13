<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Photo;
use App\User;
use App\Role;
use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use Datatables;
use DB;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        // $users=User::all();
        // return view('admin.index',compact('users'));
        // return Datatables::of($users)->make(true); 
                 // return view('admin.index',compact('users'));
        return view('admin.index');  
    }
        public function getPosts()
    {
        // $users = DB::table('users')->select(['users.name','users.id','users.email','users.email','users.created_at','users.updated_at','users.role_id']);
            $users = User::leftJoin('departments', 'users.department_id', '=',      'departments.id')
                    ->select(['users.id','departments.name as department','users.name', 'users.email','users.created_at','users.updated_at']);

            // ->leftJoin('roles','users.role_id' ,'=', 'roles.id')
            // ->get();
        return Datatables()->of($users)

          // ->addColumn('roles', function ($roles) {
          //       return $roles->name;
          //   })


          ->addColumn('action', function ($user) {
                return '<a href="admin/'.$user->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', '{{$id}}')
            ->removeColumn('password')
            ->make(true);

            // ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();



        return view('admin.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
 $input = $request->all();

        if( $file= $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;

        } 
        
        $input['password'] = bcrypt($request->password);
        User::create($input);
        Session::flash('created_user','User Created');

        return redirect ('/admin');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles= Role::pluck('name','id')->all();
        return view('admin.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
 $user=User::findOrFail($id);
        $input=$request->all();

        if($file = $request->file('photo_id')){
            $name = time(). $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;
        }

        $input['password'] = bcrypt($request->password);

        $user->update($input);
        Session::flash('updated_user','User Updated');

        return redirect ('/admin');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $user=User::findOrFail($id)->delete();
    Session::flash('deleted_user','User deleted');
    return redirect('/admin');

    }
}
