@extends('layouts.app')

@section('content')

<div class="row">
  
    <div class="col-md-12 article-cover-image"
    style="background-image: url('/uploads/summaries/{{ $book->summary_cover }}')";>
    </div>

</div>

<div class="container">

<div class="row title">
  <h2 class="col-md-8">{{ $book->title }}</h2>
</div>
<div class="row">
      @if(!Auth::guest() && ($book->author_id == Auth::user()->id || Auth::user()->is_admin()))
          <a href="{{ url('edit-book/'.$book->slug)}}">
              <i class="fa fa-sticky-note-o fa-2x edit-book" aria-hidden="true"></i>
          </a>
        @endif
      <img class= "posted-avatar col-md-1" src="/uploads/avatars/{{ $book->author->avatar }}">
      <p class="col-md-5 author-details">
        <span id="author-name">
          By 
          <a href="{{ url('/user/'.$book->author_id)}}">{{ $book->author->name }}</a>
        </span></br>
        <span id="author-bio">{{ $book->author->bio }}</span>
      </p>
  </div>

  <section class="book-meta" data-bookid="{{ $book->id }}">
            @if(Auth::guest())
            <!-- Empty if parameter to prevent error from not logged in user -->
            @elseif(!Auth::guest()) 
              <!-- Like functionality within Div (can be moved to controller) -->
              <div class="likes">
                <a href="#" class="like">{{ Auth::user()->likes()->where('book_id', $book->id)->first() 
                    ? Auth::user()->likes()->where('book_id', $book->id)->first()->like == 1 ? 'You like this Book' : 'Like' : 'Like' }}</a> |
                <a href="#" class="like">{{ Auth::user()->likes()->where('book_id', $book->id)->first() 
                    ? Auth::user()->likes()->where('book_id', $book->id)->first()->like == 0 ? 'You don\'t like this Book' : 'Dislike' : 'Dislike' }}</a>
              </div>
            @endif()
    </section><!-- Book-Title section -->

@if($book)

  <div class="book-body">
    {!! $book->body !!}
  </div>    

<!-- Comment Section of page -->
@if(Auth::guest())
    <p>Login or Register to comment!</p>
@else
<section class="row new-post">
  <div class="col-md-8 col-md-offset-2 col-sm-12">
    <header><h3>What do you have to say?</h3></header>
      <form method="post" action="/comment-book/add">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="on_book" value="{{ $book->id }}">
        <input type="hidden" name="slug" value="{{ $book->slug }}">
        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
          <textarea required="required" placeholder="Enter comment here..." name = "body" class="form-control" rows="5"></textarea>
            @if($errors->has('body'))
                <div class="help-block">
                    Please do not leave the response field blank
                </div>
             @endif
        </div>
        <input type="submit" name='book_comment' class="btn btn-primary pull-right" value = "Post Comment"/>
      </form>
  </div>
</section>
@endif

<section class="row posts">
  <div class="col-md-8 col-md-offset-2">
    @if($comments)
    <h3>What other people say...</h3>
      @foreach($comments as $comment)
        <article class="post" data-commentid="{{ $comment->id }}">
          <p>{{ $comment->body }}</p>
          <div class="info">
            <a href="{{ url('/user/'.$comment->from_user)}}"> 
            <img class= "comment-profile" src="/uploads/avatars/{{ $comment->author->avatar }}">
            {{ $comment->author->name }} </a> 
            on {{ $comment->created_at->format('M d,Y \a\t h:i a') }}
          </div>
          <div class="interaction">
              @if(Auth::guest())
                <!-- Empty if parameter to prevent error from not logged in user -->
              @elseif(Auth::user()->id == $comment->from_user || Auth::user()->is_admin())  
              <a href="#" class="edit none">Edit</a> |
              <a href="{{ route('book_comment/delete', ['id' => $comment->id]) }}" class="none">Delete</a>
              @endif()
          </div>
        </article>
      @endforeach
      {!! $comments->render() !!}
      @else
      <h3>No comments yet!</h3>
    </div>
    @endif
</section>

</div>

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
                <label for="comment-body">Edit your comment</label>
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

  <script>
    var token = '{{ Session::token() }}';
    var url = '{{ route('edit-book-comment') }}';
    var urlLike = '{{ route('like') }}';
  </script>

@else
404 error
@endif


@endsection