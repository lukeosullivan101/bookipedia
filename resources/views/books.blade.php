@extends('layouts.app')

@section('content')

<div id="subheader" class="all-books" style="background-image: url(/uploads/books-bg.jpg);">
	<div class="bg-gradient"></div>
	<div class="logo">
		<h1>Bookipedia Library</h1>
		<p>The Bookipedia Library has a vast collection of user submitted content for you to improve your own knowledge base!</p>
	</div>
</div>


	<div class="container summary_container">
	
	@if ( !$books->count() )
	<h3>No Book Summaries Available</h3>
	@else

	  @foreach( $books as $book )
	   
	    <div class="col-lg-3 col-md-3 col-sm-4 col-4 summaries" data-bookid="{{ $book->id }}">
	    
	    <a href="{{ url('book/'.$book->slug) }}">
	    	<div class="article-cover-image-small"
      			style="background-image: url('/uploads/summaries/{{ $book->summary_cover }}')";>
    		</div>
    	</a>

	      <div class="edit">
	      	@if(!Auth::guest() && ($book->author_id == Auth::user()->id || Auth::user()->is_admin()))
	          @if($book->active == '1')
	          <a href="{{ url('edit-book/'.$book->slug)}}"> <i class="fa fa-sticky-note-o fa-lg edit-book" aria-hidden="true"></i></a>
	          @endif
	        @endif
	      </div>

		<div class="book-details author-details">
		  <h3><a href="{{ url('book/'.$book->slug) }}">{{ $book->title }}</a></h3> 
	      
	      <article>
	        <a href="{{ url('book/'.$book->slug) }}">{!! str_limit($book->body, $limit = 100, $end = '.....') !!}</a>
	      </article>
			
		<p class="author-name">
	       	By <span class="author-name">
	      	<a href="{{ url('/user/'.$book->author_id)}}">{{ $book->author->name }}</a> |
	      </span>
	     	{{ $book->created_at->format('M d, Y') }} 
	      </p>

           <div class="likes-counter">
                  <i class="fa fa-thumbs-up fa-lg" aria-hidden="true">
                     <span id="like-count">{{ $book->likes()->where('like', 1)->count() }}</span>
                  </i>

                  <i class="fa fa-thumbs-down fa-lg" aria-hidden="true">
                 	 <span id="like-count">{{ $book->likes()->where('like', 0)->count() }}</span>
                  </i>
           	  </div>
              <!-- Like functionality within Div (can be moved to controller) -->	      
	    </div>

	   </div><!-- End Summaries Div -->
	  @endforeach
	</div><!-- Summary Container Div -->


<div class="container">
	  	<div class="paginate pull-right">	
	  		{!! $books->render() !!}
	  	</div>
</div>

  <script>
    var token = '{{ Session::token() }}';
    var urlLike = '{{ route('like') }}';
  </script>
	@endif


@endsection