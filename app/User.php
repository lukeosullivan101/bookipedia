<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
        NB ADMIN FUNCTIONALITY
    **/
  public function can_post()
  {
    $role_id = $this->role_id;
    if($role_id == "1" || $role_id="3")
    {
      return true;
    }
    return false;
  }

  public function is_writer()
  {
    $role_id = $this->role_id;
    if($role_id == "3")
    {
      return true;
    }
    return false;
  }

  public function is_admin()
  {
    $role_id = $this->role_id;
    if($role_id == "1")
    {
      return true;
    }
    return false;
  }
    /**
        BLOG FUNCTIONALITY
    **/
    // user has many posts
  public function posts()
  {
    return $this->hasMany('App\Post','author_id');
  }
  // user has many comments
  public function comments()
  {
    return $this->hasMany('App\Comment','from_user');
  }

    /**
        BOOK SUMMARY FUNCTIONALITY
    **/
 public function books()
  {
    return $this->hasMany('App\Book','author_id');
  }
  // user has many comments
  public function book_comments()
  {
    return $this->hasMany('App\BookComment','from_user');
  }

  public function tasks(){
    return $this->hasMany(Task::class);
  }

  public function likes(){
    return $this->hasMany('App\Like', 'user_id');
  }

    // user has many comments
  public function submissions()
  {
    return $this->hasMany('App\Submission','author_id');
  }

}
