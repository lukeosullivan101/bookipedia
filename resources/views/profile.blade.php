@extends('layouts.app')

@section('title')

@endsection

@section('content')

          <!-- User Cover image -->
          @if(Auth::user()->id == $user->id || Auth::user()->is_admin())
            <a href="{{ url('/cover')}}">
              <div class="col-md-12 cover-image cover-image-change"
                style="background-image: url('/uploads/covers/{{ $user->cover }}')";>
                <p><i class="fa fa-camera fa-2x" aria-hidden="true"></i></p>
              </div>
            </a>
            @else
                <div class="col-md-12 cover-image"
                style="background-image: url('/uploads/covers/{{ $user->cover }}')";>
                <p><i class="fa fa-camera fa-2x" aria-hidden="true"></i></p>
                </div>
            @endif

<div class="container">

<section class="profile-all">

    <div class="row profile-header">
      <!-- User profile image -->
      @if(Auth::user()->id == $user->id || Auth::user()->is_admin())
        <div class="col-md-2 profile-image profile-image-change">
                <a href="{{ url('/avatar')}}">
                    <img alt="Avatar" src="/uploads/avatars/{{ $user->avatar }}">
                    <p><i class="fa fa-camera fa-2x" aria-hidden="true"></i></p>
                </a>
        </div>
        @else
            <div class="col-md-2 profile-image">
              <img src="/uploads/avatars/{{ $user->avatar }}">
            </div>
        @endif
    </div> <!-- End title row -->
    
    <div class="row">
          <div class="col-md-4 user-details">
          <h2>{{ $user->name }}</h2>
          @if($user->is_admin())
            <h4>Bookipedia Admin</h4>
          @elseif($user->is_writer())
            <h4>Bookipedia Writer</h4>
          @endif
          <h5>Joined on {{$user->created_at->format('M d Y') }}</h5>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
          <article class="bio" data-userid="{{ $user->id }}">
          @if(!$user->bio)
            <p>{{ $user->name }} has not written a bio yet!</p>
          @else
          <p>{{ $user->bio }}</p>
          @endif
          <div class="interaction">
              @if(Auth::user()->id == $user->id || Auth::user()->is_admin())  
                  <a href="#" class="edit none">Edit Bio</a> 
              @endif()
          </div>
        </article>
      </div>
    </div>

<!-- If statement checks if user is an admin to show all available post and summary details -->


<!-- Stats Sectin -->
<section class="stats">

<h1><i class="fa fa-bolt fa-lg" aria-hidden="true"></i> Stats</h1>

<div class="statistic">
  <span id="stat"><p>{{$submitted_summaries}}</p></span>
  <p id="stat-detail">Submitted Summaries</p>
</div>

@if($user->is_admin())
<div class="statistic">
  <span id="stat"><p>{{$posts_active_count}}</p></span>
  <p id="stat-detail">Blog Posts</p>
</div>
@endif

@if($user->is_writer() || $user->is_admin())

<div class="statistic">
  <span id="stat"><p>{{$books_active_count}}</p></span>
  <p id="stat-detail">Published Summaries</p>
</div>

@endif

<div class="statistic">
  <span id="stat"><p>{{$book_comments_count}}</p></span>
  <p id="stat-detail">Book Summary Comments</p>
</div>

<div class="statistic">
  <span id="stat"><p>{{$comments_count}}</p></span>
  <p id="stat-detail">Blog Comments</p>
</div>
</section>

<section>
 <div class="reading-list-profile">

  <h1><i class="fa fa-bookmark fa-lg" aria-hidden="true"></i> {{ $user->name }}'s Reading List</h1>
    @if(!empty($reading_list_books[0]))
    
    @foreach($reading_list_books as $reading_list_book)
                    <div class="reading-list-item">
                        <p><i class="fa fa-bookmark-o" aria-hidden="true"></i> {{ $reading_list_book->name }}</p>
                    </div>
      @endforeach
    @else
          <div class="reading-list-item">
            <p>{{ $user->name }} has not added any books to their reading list!</p>
          </div>
    @endif
  </div>
</section>

<!--
ADMIN BOOK SUMMARY DETAILS
-->
@if($user->is_writer() || $user->is_admin())

<div class="col-lg-12 col-md-12 col-sm-12 summary-container-profile">
<h1><i class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i> Latest Book Summaries</h1>

  @if(!empty($latest_books[0]))
    @foreach($latest_books as $latest_book)
    <div class="col-lg-3 col-md-3 col-sm-4 col-4 summaries">
      
      <a href="{{ url('book/'.$latest_book->slug) }}">
        <div class="article-cover-image-small"
            style="background-image: url('/uploads/summaries/{{ $latest_book->summary_cover }}')";>
        </div>
      </a>

        <div class="edit">
          @if(!Auth::guest() && ($latest_book->author_id == Auth::user()->id || Auth::user()->is_admin()))
            @if($latest_book->active == '1')
            <a href="{{ url('edit-book/'.$latest_book->slug)}}"> <i class="fa fa-sticky-note-o fa-lg edit-book" aria-hidden="true"></i></a>
            @endif
          @endif
        </div>

    <div class="book-details author-details">
      <h3><a href="{{ url('book/'.$latest_book->slug) }}">{{ $latest_book->title }}</a></h3> 
      
    <p class="author-name">
          By <span class="author-name">
          <a href="{{ url('/user/'.$latest_book->author_id)}}">{{ $latest_book->author->name }}</a> |
        </span>
        {{ $latest_book->created_at->format('M d, Y') }} 
        </p>

           <div class="likes-counter">
                  <i class="fa fa-thumbs-up fa-lg" aria-hidden="true">
                     <span id="like-count">{{ $latest_book->likes()->where('like', 1)->count() }}</span>
                  </i>

                  <i class="fa fa-thumbs-down fa-lg" aria-hidden="true">
                   <span id="like-count">{{ $latest_book->likes()->where('like', 0)->count() }}</span>
                  </i>
              </div>
              <!-- Like functionality within Div (can be moved to controller) -->       

      </div>
     </div><!-- End Summaries Div -->
    @endforeach
    @else
    <h3>{{ $user->name }} has not not written any summaries till now.</h3>
@endif
</div><!-- Profile SUmmaries Container Div -->
@endif

@if($user->is_admin())
<section class="col-lg-12 col-md-12 col-sm-12 blog-container-profile">
<h1><i class="fa fa-file-text fa-lg" aria-hidden="true"></i> Latest Blog Posts</h1>

 @if(!empty($latest_posts[0]))
    @foreach( $latest_posts as $latest_post )
    <div class="col-md-12 blog">
      
      <a href="{{ url('/'.$latest_post->slug) }}">
      <div class="col-md-4 article-cover-image-small"
          style="background-image: url('/uploads/blogs/{{ $latest_post->blog_cover }}')";>
      </div>
      </a>

       <div class="col-md-8 post-details author-details">
          <h3><a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></h3>
            <div class="edit">
              @if(!Auth::guest() && ($latest_post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                <a href="{{ url('edit/'.$latest_post->slug)}}"><i class="fa fa-sticky-note-o fa-lg edit-book" aria-hidden="true"></i></a>
              @endif
          </div>
          <p class="author-name">
          By <span class="author-name">
          <a href="{{ url('/user/'.$latest_post->author_id)}}">{{ $latest_post->author->name }}</a> on
        </span>
        {{ $latest_post->created_at->format('M d, Y') }} 
        </p>
      
        <article id="blog-body">
          <a href="{{ url('/'.$latest_post->slug) }}">{!! str_limit($latest_post->body, $limit = 600, $end = '.....') !!}</a>
          <br>
        </article>
        <a class="pull-right" id="read-more" href="{{ url('/'.$latest_post->slug) }}">Read More</a>

      </div><!--Book Details Div -->
    
    </div><!-- Blog -->

    @endforeach

    @else
      <h3>{{ $user->name }} has not not written any blog posts till now.</h3>
    @endif
</section>

</section>

</div>
@endif



<!-- COMMENT POP UP MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" id="edit-bio-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Bio</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="bio-body">Edit your Bio below</label>
                <p style="float:right;">(300 Characters)</p>
                <textarea class="form-control" name="bio-body" id="bio-body" rows="8"></textarea>
                <p id="count_message" style="float:right;"></p>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-red" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-teal" id="modal-save-bio">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var token = '{{ Session::token() }}';
    var url = '{{ route('edit-bio') }}';
</script>

@endsection
