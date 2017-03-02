@extends('layouts.app')

@section('content')

<div id="subheader-blog" class="all-posts">
	<div class="bg-gradient"></div>
	<div class="logo">
		<h1> Bookipedia Blog </h1>
		<p>Check out our blog to keep up to date with all the latest Bookipedia news, releases, and more!</p>
	</div>
</div>

<div class="container">

	@if ( !$posts->count() )
	<h3>No Blog Posts Available</h3>
	@else

	<div class="row">
	  
	  @foreach( $posts as $post )
	  <div class="col-md-12 blog">
	    
	    <a href="{{ url('/'.$post->slug) }}">
	    <div class="col-md-4 article-cover-image-small"
      		style="background-image: url('/uploads/blogs/{{ $post->blog_cover }}')";>
    	</div>
    	</a>

	     <div class="col-md-8 post-details author-details">
	      	<h3><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a></h3>
	      		<div class="edit">
	      			@if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
	          		<a href="{{ url('edit/'.$post->slug)}}"><i class="fa fa-sticky-note-o fa-lg edit-book" aria-hidden="true">		</i></a>
	        		@endif
	     		</div>
	      	<p class="author-name">
	       	By <span class="author-name">
	      	<a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a> on
	      </span>
	     	{{ $post->created_at->format('M d, Y') }} 
	      </p>
			
	      <article id="blog-body">
	        <a href="{{ url('/'.$post->slug) }}">{!! str_limit($post->body, $limit = 600, $end = '.....') !!}</a>
	        <br>
	      </article>
	      <a class="pull-right" id="read-more" href="{{ url('/'.$post->slug) }}">Read More</a>

	    </div><!--Book Details Div -->
	  
	  </div><!-- Blog -->

	  @endforeach
	</div><!-- End Row -->

<div class="container">
	  	<div class="paginate pull-right">	
	  		{!! $posts->render() !!}
	  	</div>
</div>
	
@endif

</div><!--End Blog Container -->
@endsection