<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::auth();
Route::get('/logout','Auth\LoginController@logout');


Route::get('/', 'HomeController@index');

Route::group(['middleware'=>'admin'],function(){

	Route::resource('/admin','AdminUsersController',['names'=>[
		'index'=>'admin.index',
		'create'=>'admin.create',
		'store'=>'admin.store',
		'edit'=>'admin.edit'
		]]);
	Route::resource('department','DepartmentController',['names'=>[
		'index'=>'department.index'
		]]);


});



Route::group(['middleware'=>'user'],function(){

	Route::resource('/user','UsersController');
});


Route::get('admin.index', ['uses'=>'AdminUsersController@index']);
Route::get('index/getposts', ['as'=>'index.getposts','uses'=>'AdminUsersController@getPosts']);



Route::get('index', ['uses'=>'DepartmentController@index']);
Route::get('index/getdepartments', ['as'=>'index.getdepartments','uses'=>'DepartmentController@getDepartments']);


Route::get('chat', 'ChatController@chat')->middleware('auth');

Route::post('saveToSession','ChatController@saveToSession');

Route::post('deleteSession','ChatController@deleteSession');

Route::post('getOldMessage','ChatController@getOldMessage');

Route::post('send','ChatController@send');

Route::get('check',function(){
	return session('chat');
});



