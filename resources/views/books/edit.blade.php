@extends('layouts.app')

@section('content')

<div id="subheader" class="all-books" style="background-image: url(/uploads/create-bg.jpg);">
  <div class="bg-gradient"></div>
  <div class="logo">
    <h1>Edit Your Summary </h1>
    <p>Bookipedia Writers may use the editor below to edit any recent summaries they have been working on.</p>
  </div>
</div>

<div class="container">

<!-- Tiny MCE Text editor JS -->
<script type="text/javascript" src="{{ asset('/js/book_tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages",
        height : 500,
    });
</script>

<h3 class="editor-title">Summary Cover Photo</h3>
<div class="col-md-12 article-cover-image"
      style="background-image: url('/uploads/summaries/{{ $book->summary_cover }}')";>
</div>

<form enctype="multipart/form-data" method="post" action='{{ url("/update-book") }}'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="book_id" value="{{ $book->id }}{{ old('book_id') }}">

  <div class="form-group avatar-buttons">
    <input type="file" name="summary_cover" id="summary_cover" class="inputfile" >
  </div>

  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

    <h3>Summary Title</h3>
    <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$book->title}}@endif{{ old('title') }}"/>
            @if($errors->has('title'))
                <div class="help-block">
                    Please do not leave the title field blank
                </div>
             @endif
  </div>
  <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
    <h3>Summary</h3>
    <textarea name='body'>
      @if(!old('body'))
      {!! $book->body !!}
      @endif
      {!! old('body') !!}
    </textarea>
            @if($errors->has('body'))
                <div class="help-block">
                    Please do not leave the body of the summary blank
                </div>
             @endif
  </div>
  @if($book->active == '1')
  <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
  @endif
  <a href="{{  url('delete-book/'.$book->id.'?_token='.csrf_token()) }}" class="btn btn-danger pull-right">Delete</a>
</form>

</div><!-- End Container -->
@endsection