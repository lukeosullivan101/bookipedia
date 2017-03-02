<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookComment;
use App\User;
use App\Like;
use Auth;
use Image;
use File;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
  {
    //fetch summaries from database which are active and latest
    $books = Book::where('active',1)->orderBy('created_at','desc')->paginate(30);

    //return books.blade.php template from resources/views folder
    return view('/books')->withBooks($books);
  }

  public function create(Request $request)
  {
    // if user can post i.e. user is admin
    if($request->user()->can_post())
    {
      return view('books.create');
    }    
    else 
    {
      return redirect('/books')->withErrors('You have not got sufficient permissions for writing book summaries');
    }
  }

//Store Book Summaries Functionality
  public function store(Request $request)
  {

    $this->validate($request, [
        'title'=>'required',
        'body'=>'required'
    ]);

    $book = new Book();

    $book->title = $request->get('title');
    $book->body = $request->get('body');
    $book->slug = str_slug($book->title);
    $book->author_id = $request->user()->id;
    if($request->has('save'))
    {
      $book->active = 0;
      $message = 'Book saved successfully';            
    }            
    else 
    {
      $book->active = 1;
      $message = 'Book published successfully';
    }
    $book->save();
    return redirect('edit-book/'.$book->slug)->withMessage($message);
  }

  /**
  This function is taking slug as argument and in line 3 post is fetched from database. 
  If post exits then we are fetching comments. This relation between Book model and comments is defined in 
  comments() function in Book model.
  **/
  public function show($slug)
  {
    $book = Book::where('slug',$slug)->first();
    $book_comments = BookComment::where('on_book', $book->id)->orderBy('created_at','desc')->paginate(10);

    if(!$book)
    {
       return redirect('/home')->withErrors('Requested page not found');
    }

    return view('books.show')->withBook($book)->withComments($book_comments);
  }

  //Sending the form for editing a book summary
  public function edit(Request $request,$slug)
  {
    $book = Book::where('slug',$slug)->first();
    if($book && ($request->user()->id == $book->author_id || $request->user()->is_admin()))
    return view('books.edit')->with('book',$book);
    return redirect('/books')->withErrors('You do not have sufficient permissions');
  }

  //Once edit form received, update db
  public function update(Request $request)
  {
    $this->validate($request, [
        'title'=>'required',
        'body'=>'required'
    ]);

    $book_id = $request->input('book_id');
    $book = Book::find($book_id);
    if($book && ($book->author_id == $request->user()->id || $request->user()->is_admin()))
    {
      $title = $request->input('title');
      $slug = str_slug($title);
      $duplicate = Book::where('slug',$slug)->first();
      if($duplicate)
      {
        if($duplicate->id != $book_id)
        {
          return redirect('edit-book/'.$book->slug)->withErrors('Title already exists.')->withInput();
        }
        else 
        {
          $book->slug = $slug;
        }
      }

      //Image Upload Logic
      if($request->hasFile('summary_cover')){
         $summary_cover = $request->file('summary_cover');
         $filename = time().'.'.$summary_cover->getClientOriginalExtension();
            // Delete current image before uploading new image
            if($book->summary_cover !== 'summary_default.jpg') {
                $file = public_path('uploads/summaries/' . $book->summary_cover);

                if (File::exists($file)) {
                    unlink($file);
                }//END INNER INNER IF
            }//END INNER IF
        Image::make($summary_cover)->save(public_path('/uploads/summaries/'.$filename));
        $book->summary_cover = $filename;
      }//END IF

      $book->title = $title;
      $book->body = $request->input('body');
      if($request->has('save'))
      {
        $book->active = 0;
        $message = 'Post saved successfully';
        $landing = 'edit-book/'.$book->slug;
      }            
      else {
        $book->active = 1;
        $message = 'Book Summary updated successfully';
        $landing = 'book/'.$book->slug;
      }
      $book->save();
           return redirect($landing)->withMessage($message);
    }
    else
    {
      return redirect('/books')->withErrors('You do not have sufficient permissions');
    }
  }//END FUNCTION

  //Destroy function used to delete books. Only admin has permission
  public function destroy(Request $request, $id)
  {
    //
    $book = Book::find($id);
    if($book && ($book->author_id == $request->user()->id || $request->user()->is_admin()))
    {
      $book->delete();
      $data['message'] = 'Book Summary deleted successfully';
    }
    else 
    {
      $data['errors'] = 'Invalid Operation. You have not got sufficient permissions';
    }
    return redirect('/books')->with($data);
  }

  //function for liking book posts
  public function likeBook(Request $request){
      $book_id = $request['bookId'];
      $is_like = $request['isLike'] === 'true' ? true : false;
      $update = false;
      $book = Book::find($book_id);

      if(!$book){
        return null;
      }
      $user = Auth::user();
      $like = $user->likes()->where('book_id', $book_id)->first();
      if($like){
        $already_like = $like->like;
        $update = true;
          if($already_like == $is_like){
            $like->delete();
            return null;
          } //INNER IF
      }//OUTER IF
      else{
        $like = new Like();
      }// OUTER IF ELSE STATEMENT
      $like->like = $is_like;
      $like->user_id = $user->id;
      $like->book_id = $book->id;
      if($update){
        $like->update();
      }
      else{
        $like->save();
      }
      return null;
  }// End likeBook Function
     
} //End Controller
