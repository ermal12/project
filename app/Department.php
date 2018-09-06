<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	    protected $fillable = ['name','description','parent_id','status'];

    public function user(){
    	return $this->hasMany('App\User');
    }

}
