<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\Photo;
use App\User;
use App\Role;
use App\Todo;
use App\Http\Requests\UsersRequest;
use Auth;





class UsersController extends Controller
{
        public function __construct()
    {
        $this->middleware('user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Auth::user()->id!=$id)
        return redirect()->back()->with('msg','User not found');
        $user = User::findOrFail($id);
        $todos=Todo::paginate(5);
        $todocount=Todo::count();
        $roles= Role::pluck('name','id')->all();
        return view('user.index',compact('user','roles','todos','todocount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if(Auth::user()->id!=$id)
      return redirect()->back()->with('msg','User not found');

        $user = User::findOrFail($id);
        $roles= Role::pluck('name','id')->all();
        return view('user.index',compact('user','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id!=$id)
        return redirect()->back()->with('msg','User not found');

        $user = User::findOrFail($id);
        $roles= Role::pluck('name','id')->all();
        return view('user.edit',compact('user','roles'));
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

        return redirect ('user/' . $user->id );


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
    return redirect('/');
    }
}
