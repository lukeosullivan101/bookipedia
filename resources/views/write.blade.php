@extends('layouts.app')

@section('content')

<div id="subheader" class="all-books" style="background-image: url(/uploads/write-bg.jpg);">
  <div class="bg-gradient"></div>
  <div class="logo">
    <h1>Write For Us</h1>
    <p>The Bookipedia Community is powered by it's writers, which is why we want the best writers to join our team.
    </p>
  </div>
</div>

<div class="container">

<script type="text/javascript" src="{{ asset('/js/book_tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
        selector : "textarea",
        plugins : ["advlist autolink lists link charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
        height : 500,
    });
</script>

   	<div class="heading col-md-12">
   			<h3>Becoming a Bookipedia Writer allows you to:</h3>
   			<p>-Show your own writing prowess</p>
   			<p>-Gives you access to select admin privileges</p>
   			<p>-Build your writing experience and writing credentials</p>
   			<p>-Be at the very centre of this growing online community</p>
   			<p>In order to become a Bookipedia Writer, simply send us 4-6 book summaries which we will review as part
   			of your application and if they meet the required standards then they will get featured on the site and we'll bring you onto our team. Good luck!</p>
   		</div>
   		<div class="write-form">
            <form class="" role="form" method="POST" action="/write">
                   {{ csrf_field() }}
                    <div class="form-group col-md-12 {{ $errors->has('title') ? 'has-error' : '' }}">
                        <h3>Summary Title:</h3>
                            <input required="required" value="{{ old('title') }}" placeholder="Enter title here..." type="text" name = "title" id="title" class="form-control" />
                             @if($errors->has('summary'))
                                <div class="help-block">
                            Please do not leave the title field blank
                                </div>
                              @endif
                    </div>

                    <div class="form-group col-md-12 {{ $errors->has('summary') ? 'has-error' : '' }}">
                      <h3>Summary Body</h3>
                      <textarea name='summary' class="form-control">{{ old('summary') }}</textarea>
                      @if($errors->has('summary'))
                             <div class="help-block">
                                Please do not leave the body of the summary blank
                           </div>
                          @endif      
                    </div>

                 <div class="form-group col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary btn-teal pull-right">
                             Submit Summary
                         </button>
                </div>
             </form>
   		</div>
   	</div><!--Container Div -->

@endsection