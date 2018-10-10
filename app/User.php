<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
        use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','photo_id','department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public  function role () {
        return $this->belongsTo('App\Role');
    }



   public function photo (){
        return $this->belongsTo('App\Photo');
    }


   public function department (){
        return $this->belongsTo('App\Department');
    }


public function messages()
{
  return $this->hasMany(Message::class);
}


public function todos()
{
  return $this->hasMany('App\Todo');
}


 public function isAdmin(){
    if($this->role->name == 'admin'){
        return true;
    }
    return false;
 }


 public function isUser(){


        if($this->role->name == 'user'){
        return true;
    }
    return false;
 }




 }
