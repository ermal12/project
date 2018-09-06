<?php
/**
*@title: Custom hleper
*author : Ermal
*/


/*
*Helper name : subDepartments
* return sub department
* passing params : parent id
* return : sub department name
*/
function subDepartments($id)
{
	return \App\Department::where('parent_id',$id)->get();

}



?>