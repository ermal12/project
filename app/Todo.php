<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  use SluggableScopeHelpers;
  use Sluggable;

  public function sluggable()
      {
          return [
              'slug' => [
                  'source' => 'body',
                  'onUpdate'  => true,
              ]
          ];
      }

  protected $fillable = [
      'body'
  ];
    public function user ()
    {
        return $this->belongsTo('User\App');
    }
}
