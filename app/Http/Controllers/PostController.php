<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\User;
use Image;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\PostFormRequest;

class PostController extends Controller
{
    public function index()
  {
    //fetch 10 posts from database which are active and latest
    $posts = Post::where('active',1)->orderBy('created_at','desc')->paginate(10);

    //return blog.blade.php template from resources/views folder
    return view('/blog')->withPosts($posts);
  }

  public function create(Request $request)
  {
    // if user can post i.e. user is admin
    if($request->user()->can_post() && $request->user()->is_admin() )
    {
      return view('posts.create');
    }    
    else 
    {
      return redirect('/blog')->withErrors('You have not sufficient permissions for writing blog posts');
    }
  }

  public function store(Request $request)
  {
    
    $this->validate($request, [
        'title'=>'required',
        'body'=>'required'
    ]);

    $post = new Post();
    $post->title = $request->get('title');
    $post->body = $request->get('body');
    $post->slug = str_slug($post->title);
    $post->author_id = $request->user()->id;
    if($request->has('save'))
    {
      $post->active = 0;
      $message = 'Post saved successfully';            
    }            
    else 
    {
      $post->active = 1;
      $message = 'Post published successfully';
    }
    $post->save();
    return redirect('edit/'.$post->slug)->withMessage($message);
  }

  /**
  This function is taking slug as argument and in line 3 post is fetched from database. 
  If post exits then we are fetching comments. This relation between Post model and comments is defined in 
  comments() function in Post model.
  **/
  public function show($slug)
  {
    $post = Post::where('slug',$slug)->first();
    $comments = Comment::where('on_post', $post->id)->orderBy('created_at','desc')->paginate(10);
    if(!$post)
    {
       return redirect('/home')->withErrors('Requested page not found');
    }
    return view('posts.show')->withPost($post)->withComments($comments);
  }

  //Sending the form for editing a post
  public function edit(Request $request,$slug)
  {

    $post = Post::where('slug',$slug)->first();
    if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
      return view('posts.edit')->with('post',$post);
    return redirect('/')->withErrors('you have not sufficient permissions');
  }

  //Once edit form received, update db
  public function update(Request $request)
  {
    $this->validate($request, [
        'title'=>'required',
        'body'=>'required'
    ]);

    $post_id = $request->input('post_id');
    $post = Post::find($post_id);
    if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
    {
      $title = $request->input('title');
      $slug = str_slug($title);
      $duplicate = Post::where('slug',$slug)->first();
      if($duplicate)
      {
        if($duplicate->id != $post_id)
        {
          return redirect('edit/'.$post->slug)->withErrors('Title already exists.')->withInput();
        }
        else 
        {
          $post->slug = $slug;
        }
      }

      //Image Upload Logic
      if($request->hasFile('blog_cover')){
         $blog_cover = $request->file('blog_cover');
         $filename = time().'.'.$blog_cover->getClientOriginalExtension();
            // Delete current image before uploading new image
            if($post->blog_cover !== 'blog_default.jpg') {
                $file = public_path('uploads/blogs/' . $post->blog_cover);

                if (File::exists($file)) {
                    unlink($file);
                }//END INNER INNER IF
            }//END INNER IF
        Image::make($blog_cover)->save(public_path('/uploads/blogs/'.$filename));
        $post->blog_cover = $filename;
      }//END IF

      $post->title = $title;
      $post->body = $request->input('body');
      if($request->has('save'))
      {
        $post->active = 0;
        $message = 'Post saved successfully';
        $landing = 'edit/'.$post->slug;
      }            
      else {
        $post->active = 1;
        $message = 'Post updated successfully';
        $landing = $post->slug;
      }
      $post->save();
           return redirect($landing)->withMessage($message);
    }
    else
    {
      return redirect('/blog')->withErrors('You do not have sufficient permissions');
    }
  }

  //Destroy function used to delete post. Only admin has permission
  public function destroy(Request $request, $id)
  {
    //
    $post = Post::find($id);
    if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
    {
      $post->delete();
      $data['message'] = 'Post deleted successfully';
    }
    else 
    {
      $data['errors'] = 'Invalid Operation. You have not got sufficient permissions';
    }
    return redirect('/blog')->with($data);
  }
     
} //End Controller
