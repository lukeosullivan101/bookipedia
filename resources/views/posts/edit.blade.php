@extends('layouts.app')

@section('content')

<div id="subheader" class="all-books" style="background-image: url(/uploads/createblog-bg.jpg);">
  <div class="bg-gradient"></div>
  <div class="logo">
    <h1>Edit Blog Post</h1>
    <p>Bookipedia Admins may use the editor below to edit any blog posts they have posted.</p>
  </div>
</div>

<div class="container">

<!-- Tiny MCE Text editor JS -->
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages",
        height : 500,
    });
</script>

<h3 class="editor-title">Blog Post Cover Photo</h3>
<div class="col-md-12 article-cover-image"
      style="background-image: url('/uploads/blogs/{{ $post->blog_cover }}')";>
</div>

<form enctype="multipart/form-data" method="post" action='{{ url("/update") }}'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
  
  <div class="form-group {{ $errors->has('blog_cover') ? 'has-error' : '' }}">
    <input type="file" name="blog_cover" id="blog_cover" class="inputfile" >
              @if($errors->has('blog_cover'))
                <div class="help-block">
                    Please upload an image cover
                </div>
             @endif
   </div>

  <h3>Blog Post Title</h3>
  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
          @if($errors->has('title'))
                <div class="help-block">
                    Please do not leave the title field blank
                </div>
          @endif
  </div>

  <h3>Blog Post Body</h3>
  <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
    <textarea name='body'>
      @if(!old('body'))
      {!! $post->body !!}
      @endif
      {!! old('body') !!}
    </textarea>
      @if($errors->has('body'))
                <div class="help-block">
                    Please do not leave the body of the blog post blank
                </div>
       @endif
  </div>
  @if($post->active == '1')
  <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
  @else
  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
  @endif
  <a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger pull-right">Delete</a>
</form>

</div> <!-- End Container -->
@endsection