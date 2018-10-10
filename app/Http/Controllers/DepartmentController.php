<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Photo;
use App\User;
use App\Role;
use App\Department;
use App\Todo;
use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\DepartmentRequest;
use Datatables;
use DB;

class DepartmentController extends Controller
{


    // public function manageCategory()
    // {
    //     $categories = Category::where('parent_id', '=', 0)->get();
    //     $allCategories = Category::pluck('title','id')->all();
    //     return view('categoryTreeview',compact('categories','allCategories'));
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $users=User::all();
        $parents = Department::where('parent_id', '=', 0)->get();
        $data['departments'] = Department::all();
        $departments=Department::pluck('name','id')->all();
        $todos=Todo::paginate(5);
        $todocount=Todo::count();
        return view('department.index',compact('parents','departments','todos','todocount'),$data);
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {


        // Department::create($request->all());
        // return redirect('/department');

        // $this->validate($request, [
        //         'description' => 'required',
        //     ]);

  // dd($request->all());

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        Department::create($input);
        Session::flash('department_created','Department Created');

        return back();

        // $input = $request->all();
        // Department::create($input);
        // return redirect ('/department');



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
        $department=Department::findOrFail($id);
        $departments=Department::pluck('name','id')->all();
        $todos=Todo::paginate(5);
        $todocount=Todo::count();
        return view('department.edit',compact('department','todos','todocount','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department=Department::findOrFail($id);
        $input=$request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        $department->update($input);
        return redirect('/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::findOrFail($id)->delete();
        Session::flash('department_deleted','Department Deleted');
        return redirect('/department');
    }
    public function departments()
    {
      $departments=Department::all();
      $todos=Todo::paginate(5);
      $todocount=Todo::count();
      return view('department.alldepartments', compact('departments','todos','todocount'));
    }
}
