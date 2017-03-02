<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Book;
use Image;
use File;
Use Auth;

class UserController extends Controller
{
      /*
   * Display active posts of a particular user
   * 
   * @param int $id
   * @return view
   */
  public function user_posts($id)
  {
    //
    $posts = Post::where('author_id',$id)->where('active',1)->orderBy('created_at','desc')->paginate(10);
    $title = User::find($id)->name;
    return view('blog')->withPosts($posts)->withTitle($title);
  }

   public function user_books($id)
  {
    //
    $books = Book::where('author_id',$id)->where('active',1)->orderBy('created_at','desc')->paginate(30);
    $title = User::find($id)->name;
    return view('books.my-books')->withBooks($books)->withTitle($title);
  }

    public function editBio(Request $request){
    $this->validate($request, [
        'bio' => 'required'
    ]);
    $user = User::find($request['userId']);
    if($user && (Auth::user()->id == $request->user()->id || $request->user()->is_admin())){
      $user->bio = $request['bio'];
      $user->update();
    }
    else{
      $data['message'] = 'Invalid Operation. You have not got sufficient permissions to delete this comment';
      return redirect('/home')->with($data);
    }
    return response()->json(['new_bio' => $user->bio], 200);
  }
  /*
   * Display all of the posts of a particular user
   * 
   * @param Request $request
   * @return view
   */
  public function user_posts_all(Request $request)
  {
    //
    $user = $request->user();
    $posts = Post::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(30);
    $title = $user->name;
    return view('blog')->withPosts($posts)->withTitle($title);
  }

    public function user_books_all(Request $request)
  {
    //
    $user = $request->user();
    $books = Book::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(30);
    $title = $user->name;
    return view('books')->withBooks($books)->withTitle($title);
  }
  /*
   * Display draft posts of a currently active user
   * 
   * @param Request $request
   * @return view
   */
  public function user_posts_draft(Request $request)
  {
    //
    $user = $request->user();
    $posts = Post::where('author_id',$user->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('blog')->withPosts($posts)->withTitle($title);
  }

    public function user_books_draft(Request $request)
  {
    //
    $user = $request->user();
    $books = Book::where('author_id',$user->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('books')->withBooks($books)->withTitle($title);
  }

  public function avatar(){
    return view('avatar', array('user' => Auth::user() ));
  }

  public function update_avatar(Request $request){
    //Handle User upload of avatar
      if($request->hasFile('avatar'))
      {
        $user = Auth::user();
        $avatar = $request->file('avatar');
        $filename = time().'.'.$avatar->getClientOriginalExtension();
        // Delete current image before uploading new image
            if ($user->avatar !== 'default.jpg') {
                $file = public_path('uploads/avatars/' . $user->avatar);

                if (File::exists($file)) {
                    unlink($file);
                }

            }
        Image::make($avatar)->fit(300,300)->save( public_path('/uploads/avatars/'.$filename));
        $user->avatar = $filename;
        $user->save();
      }
      return view('avatar', array('user' => Auth::user() ));
  }
  /**
   * cover photo for user
   */
    public function cover(){
    return view('cover', array('user' => Auth::user() ));
  }

  public function update_cover(Request $request){
    //Handle User upload of avatar
      if($request->hasFile('cover'))
      {
        $user = Auth::user();
        $cover = $request->file('cover');
        $filename = time().'.'.$cover->getClientOriginalExtension();
        // Delete current image before uploading new image
            if ($user->cover!== 'cover_default.jpg') {
                $file = public_path('uploads/covers/' . $user->cover);

                if (File::exists($file)) {
                    unlink($file);
                }

            }
        Image::make($cover)->fit(300,300)->save( public_path('/uploads/covers/'.$filename));
        $user->cover = $filename;
        $user->save();
      }
      return view('cover', array('user' => Auth::user() ));
  }
  /**
   * profile for user
   */
  public function profile(Request $request, $id) 
  {
    $data['user'] = User::find($id);
    if (!$data['user'])
      return redirect('/');
    if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
      $data['admin'] = true;
    } else {
      $data['admin'] = null;
    }
    $data['comments_count'] = $data['user'] -> comments -> count();
    $data['posts_count'] = $data['user'] -> posts -> count();
    $data['posts_active_count'] = $data['user'] -> posts -> where('active', '1') -> count();
    $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
    $data['latest_posts'] = $data['user'] -> posts -> where('active', '1') -> take(3);
    $data['latest_comments'] = $data['user'] -> comments -> take(3);
    $data['book_comments_count'] = $data['user'] -> book_comments -> count();
    $data['books_count'] = $data['user'] -> books -> count();
    $data['books_active_count'] = $data['user'] -> books -> where('active', '1') -> count();
    $data['books_draft_count'] = $data['books_count'] - $data['books_active_count'];
    $data['latest_books'] = $data['user'] -> books -> where('active', '1') -> take(8);
    $data['latest_book_comments'] = $data['user'] -> book_comments -> take(3);
    $data['reading_list_books'] = $data['user'] -> tasks;
    $data['submitted_summaries'] = $data['user'] -> submissions -> count();
    return view('profile', $data);
  }
}
