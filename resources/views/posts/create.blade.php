@extends('layouts.app')


@section('content')

<div id="subheader" class="all-books" style="background-image: url(/uploads/createblog-bg.jpg);">
  <div class="bg-gradient"></div>
  <div class="logo">
    <h1>Publish Blog Post</h1>
    <p>Bookipedia Admins may use the editor below to publish any blog posts.</p>
  </div>
</div>

<div class="container">



<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages",
         height : 500,
    });
</script>

	<form action="/new-post" method="post">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">

	  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <h3>Blog Post Title</h3>
	    <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title" class="form-control" />
			@if($errors->has('title'))
                <div class="help-block">
                    Please do not leave the title field blank
                </div>
             @endif
	  </div>

	  <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
    <h3>Blog Post Title</h3>
	  <textarea name='body' class="form-control">{{ old('body') }}</textarea>
		@if($errors->has('title'))
                <div class="help-block">
                    Please do not leave the blog body blank
                </div>
             @endif
	  </div>
	  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
	</form>

</div><!-- End Container -->
@endsection