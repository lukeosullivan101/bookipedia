@extends('layouts.app')

@section('content')

<div id="subheader" class="all-books" style="background-image: url(/uploads/write-bg.jpg);">
  <div class="bg-gradient"></div>
  <div class="logo">
    <h1>Submissions</h1>
    <p>Use the page below to review the most recent summary submissions.
    </p>
  </div>
</div>

<div class="container">

  @if ( !$submissions->count() )
  No Submissions Available
  @else
  <div class="row">
    @foreach( $submissions as $submission )
      <div class="col-md-offset-1 col-md-10 submissions">
        
        @if(!Auth::guest() && (Auth::user()->is_admin()))
        <a href="{{ route('submission/delete', ['id' => $submission->id]) }}">
        <i id="delete" class="fa fa-times fa-4x delete-item" aria-hidden="true"></i>
        </a>
        @endif

        <h3>{{ $submission->title }} </h3>

        <p class="author-details">{{ $submission->created_at->format('M d,Y \a\t h:i a') }} 
        By 
        <span id="author-name">
          <a href="{{ url('/user/'.$submission->author_id)}}"" class="author-details">{{ $submission->author->name }}</a></span></p>
      
      <div class="book-body">
          {!! $submission->summary !!}
      </div>

     </div><!-- Outer Summary Div -->
    @endforeach
  </div><!-- Summary Row Div -->

  <div class="row">
      <div class="paginate pull-right"> 
        {!! $submissions->render() !!}
      </div>
    </div>

  @endif

</div><!-- End Container Div -->
@endsection