<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Redirect;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

   public function store(Request $request)
  {
    //on_post, from_user, body
    //Comment Validation
    $this->validate($request, [
        'body'=>'required'
      ]);
    $input['from_user'] = $request->user()->id;
    $input['on_post'] = $request->input('on_post');
    $input['body'] = $request->input('body');
    $slug = $request->input('slug');
    if(Comment::create( $input )) {
      return redirect($slug)->with('message', 'Comment posted!'); 
    }
    else{
      return redirect($slug)->with('message', 'There was an error posting your comment!');
    }  
  }

  public function getDeleteComment(Request $request, $id){
    $comment = Comment::where('id', $id)->first();
    if($comment && ($comment->from_user == $request->user()->id || $request->user()->is_admin()))
      {
        $comment->delete();
        $data['message'] = 'Your comment has been deleted!';
      }
      else 
      {
        $data['message'] = 'Invalid Operation. You have not got sufficient permissions to delete this comment';
      }
    return redirect('/blog')->with($data);
  }

  public function editComment(Request $request){
    $this->validate($request, [
        'body' => 'required'
      ]);
    $comment = Comment::find($request['commentId']);
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

} //End Class
