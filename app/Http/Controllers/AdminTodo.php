<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

use App\Todo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;


class AdminTodo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $todos=Todo::paginate(5);
      $todocount=Todo::count();
      return view('todo.create',compact('todos','todocount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $input=$request->all();
        Todo::create($input);
        Session::flash('todo_created','Todo Created');

        return redirect('/admin');

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
    public function edit($slug)
    {
      $todo=Todo::findBySlugOrFail($slug);
      $todos=Todo::paginate(5);
      $todocount=Todo::count();
        return view('todo.edit',compact('todo','todos','todocount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, $id)
    {
        $todo=Todo::findOrFail($id);
        $input=$request->all();
        $todo->update($input);
        Session::flash('todo_updated','Todo Updated');
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
        $todo=Todo::findOrFail($id)->delete();
        Session::flash('todo_deleted','Todo Deleted');
        return redirect('/admin');

    }
}
