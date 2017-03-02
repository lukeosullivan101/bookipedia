@extends('layouts.app')

@section('content')
@if($post)
<div class="col-md-12 article-cover-image-blog"
    style="background-image: url('/uploads/blogs/{{ $post->blog_cover }}')";>
</div>

<div class="container blog-container">
      
    <h3>{{ $post->title }}</h3>

    @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
          <a href="{{ url('edit/'.$post->slug)}}">
              <i class="fa fa-sticky-note-o fa-2x edit-book" aria-hidden="true"></i>
          </a>
    @endif
  @else
    Page does not exist
  @endif

<p class="author-details">{{ $post->created_at->format('M d,Y \a\t h:i a') }} By 
    <img class= "posted-avatar-blog" src="/uploads/avatars/{{ $post->author->avatar }}">
    <span id="author-name">  
      <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a>
    </span>
 </p>

@if($post)
  <div>
    {!! $post->body !!}
  </div>

<!-- Comment Section of page -->
@if(Auth::guest())
    <p>Login or Register to comment!</p>
@else
<section class="row new-post">
  <div class="col-md-6 col-md-offset-3">
    <header><h3>What do you have to say?</h3></header>
      <form method="post" action="/comment/add">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="on_post" value="{{ $post->id }}">
        <input type="hidden" name="slug" value="{{ $post->slug }}">
        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
          <textarea required="required" placeholder="Enter your response here..." name = "body" class="form-control"></textarea>
            @if($errors->has('body'))
              <div class="help-block">
                    Please do not leave the response field blank
              </div>
             @endif
        </div>
        <input type="submit" name='post_comment' class="btn btn-primary" value = "Post Comment"/>
      </form>
  </div>
</section>
@endif

<section class="row posts">
  <div class="col-md-6 col-md-offset-3">
    @if($comments)
    <header><h3>What other people say...</h3></header>
      @foreach($comments as $comment)
        <article class="post" data-commentid="{{ $comment->id }}">
          <p>{{ $comment->body }}</p>
          <div class="info">
            Posted by <a href="{{ url('/user/'.$comment->from_user)}}"> 
            <img class= "comment-profile" src="/uploads/avatars/{{ $comment->author->avatar }}">
            {{ $comment->author->name }} </a> on {{ $comment->created_at->format('M d,Y \a\t h:i a') }}
          </div>
          @if(Auth::guest())
            <div class="interaction-guest"></div>
          @else
            <div class="interaction">
                @if(Auth::user()->id == $comment->from_user || Auth::user()->is_admin())  
                  <a href="#" class="edit">Edit</a> |
                  <a href="{{ route('comment/delete', ['id' => $comment->id]) }}">Delete</a>
                @endif()
            </div>
          @endif
        </article>
      @endforeach
      {!! $comments->render() !!}
      @else
      <header><h3>No comments yet!</h3></header>
    </div>
    @endif
</section>

<!-- COMMENT POP UP MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Comment</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="comment-body">Edit your comment.</label>
                <textarea class="form-control" name="comment-body" id="comment-body" rows="8"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-red" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-teal" id="modal-save">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div><!-- End Blog Container -->

<script>
    var token = '{{ Session::token() }}';
    var url = '{{ route('edit-comment') }}';
</script>

@else
404 error
@endif
@endsection