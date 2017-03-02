<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//insance of Post class will refer to posts table in database
class Post extends Model
{
  //$guarded variable is used to prevent inserting/ updating some columns of the table.
  protected $guarded = [];
  // posts has many comments
  // returns all comments on that post
  public function comments()
  {
    return $this->hasMany('App\Comment','on_post');
  }
  // returns the instance of the user who is author of that post
  public function author()
  {
    return $this->belongsTo('App\User','author_id');
  }
}