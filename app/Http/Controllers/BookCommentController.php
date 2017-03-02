<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\BookComment;
use Redirect;
use App\Http\Controllers\Controller;

class BookCommentController extends Controller
{
   public function store(Request $request)
  {
    //on_post, from_user, body
        //Comment Validation
    $this->validate($request, [
        'body'=>'required'
      ]);
    $input['from_user'] = $request->user()->id;
    $input['on_book'] = $request->input('on_book');
    $input['body'] = $request->input('body');
    $slug = $request->input('slug');
    if(BookComment::create( $input )) {
      return redirect('book/'.$slug)->with('message', 'Comment posted!'); 
    }
    else{
      return redirect('book/'.$slug)->with('message', 'There was an error posting your comment!');
    }     
  }

  public function getDeleteComment(Request $request, $id){
    $book_comment = BookComment::where('id', $id)->first();
    if($book_comment && ($book_comment->from_user == $request->user()->id || $request->user()->is_admin()))
      {
        $book_comment->delete();
        $data['message'] = 'Your comment has been deleted!';
      }
      else 
      {
        $data['message'] = 'Invalid Operation. You have not got sufficient permissions to delete this comment';
      }
    return redirect('/books')->with($data);
  }

    public function editComment(Request $request){
    $this->validate($request, [
        'body' => 'required'
      ]);
    $comment = BookComment::find($request['commentId']);
    if($comment && ($comment->from_user == $request->user()->id || $request->user()->is_admin())){
      $comment->body = $request['body'];
      $comment->update();
    }
    else{
      $data['message'] = 'Invalid Operation. You have not got sufficient permissions to delete this comment';
      return redirect('/blog')->with($data);
    }
    return response()->json(['new_body' => $comment->body], 200);
  }

}
