<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

//insance of Book class will refer to books table in database
class Book extends Model
{

  use Searchable;

  public function searchableAs(){
      return 'books';
  }
  //$guarded variable is used to prevent inserting/ updating some columns of the table.
  protected $guarded = [];
  // books has many comments
  // returns all comments on that post
  public function comments()
  {
    return $this->hasMany('App\BookComment','on_book');
  }
  // returns the instance of the user who is author of that book
  public function author()
  {
    return $this->belongsTo('App\User','author_id');
  }

  public function likes(){
    return $this->hasMany('App\Like', 'book_id');
  } 

}
