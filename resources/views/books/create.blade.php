@extends('layouts.app')

@section('content')

<div id="subheader" class="all-books" style="background-image: url(/uploads/create-bg.jpg);">
	<div class="bg-gradient"></div>
	<div class="logo">
		<h1> Publish Your Summary </h1>
		<p>Bookipedia Writers may use the editor below to publish any recent summaries they have been working on.</p>
	</div>
</div>

<div class="container">

<script type="text/javascript" src="{{ asset('/js/book_tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages",
        height : 500,

    });
</script>

	<form action="/new-book" method="post">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
	  
	  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	    <h3>Summary Title</h3>
	    <input required="required" value="{{ old('title') }}" placeholder="Enter title here..." type="text" name = "title" class="form-control" />
	    	@if($errors->has('title'))
			       <div class="help-block">
				        Please do not leave the title field blank
				   </div>
  		    @endif
	  </div>
	  <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
	  	<h3>Summary Body</h3>
	    <textarea name='body' class="form-control">{{ old('body') }}</textarea>
			@if($errors->has('body'))
			       <div class="help-block">
				        Please do not leave the body of the summary blank
				   </div>
  		    @endif	    
	  </div>
	  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>

	</form>

</div> <!-- End Container -->
@endsection