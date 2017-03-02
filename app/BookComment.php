<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{
  //comments table in database
  protected $guarded = [];
  // user who has commented
  public function author()
  {
    return $this->belongsTo('App\User','from_user');
  }
  // returns book of any comment
  public function book()
  {
    return $this->belongsTo('App\Book','on_book');
  }
}
