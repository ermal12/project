<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Photo;
use App\User;
use App\Role;
use App\Todo;
use App\Department;
use App\Http\Requests;
use App\Http\Requests\AdminUsersRequest;
use Datatables;
use DB;


class AdminUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
      $users=User::all();
      $user=User::count();
      $todos=Todo::paginate(5);
      $todocount=Todo::count();
      $departments=Department::count();

        return view('admin.index',compact('users','user','departments','todos','todocount'));
    }





    public function getPosts()
{

        $users = User::leftJoin('departments', 'users.department_id', '=',      'departments.id')
                ->select(['users.id','departments.name as departments','users.name', 'users.email','users.created_at','users.updated_at']);


    return Datatables()->of($users)



      ->addColumn('action', function ($user) {
            return '<a href="admin/'.$user->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="admin/'.$user->id.'/delete" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</a>  ';
        })
        ->editColumn('id', '{{$id}}')
        ->removeColumn('password')
        ->make(true);





}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();

        $departments=Department::pluck('name','id')->all();
        $todos=Todo::paginate(5);
        $todocount=Todo::count();
        return view('admin.create',compact('roles','departments','todos','todocount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersRequest $request)
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
        Session::flash('user_created','User Created');

        return redirect ('/admin');
        // return $request->all();
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
        $departments =Department::pluck('name','id')->all();
        $todos=Todo::paginate(5);
        $todocount=Todo::count();
        return view('admin.edit',compact('user','roles','departments','todos','todocount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUsersRequest $request, $id)
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
        Session::flash('user_updated','User Updated');

        return redirect('/admin');


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
    Session::flash('user_deleted','User deleted');
    return redirect('/admin');

    }

    public function panel()
    {
      $users=User::count();
      $departments=Department::count();
      $photos=Photo::count();
      $todos=Todo::paginate(5);
      $todocount=Todo::count();
      return view('admin.panel',compact('users','departments','photos','todos','todocount'));
    }

    public function datatables()
    {
      $users=User::all();
      $todos=Todo::paginate(5);
      $todocount=Todo::count();
      return view('admin.datatables', compact('users','todos','todocount'));
    }
    public function simpletable()
    {
      $users=User::paginate(5);
      $todos=Todo::paginate(5);
      $todocount=Todo::count();
      return view('admin.simpletable', compact('users','todos','todocount'));
    }

}
