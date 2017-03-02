@extends('layouts.app')

@section('content')

<div class="container">
<h3>Update Cover Photo</h3>

<div class="row">
<div class="col-md-12 cover-image-edit">
    <div class="cover-details">
      <h3>{{ $user->name }}'s Cover Photo</h3>
      <p>Simply choose an image for your cover photo below, and once selected, hit the 'Update' button.</p>
    </div>

    <div class="col-md-12 article-cover-image"
           style="background-image: url('/uploads/covers/{{ $user->cover }}')";>
     </div>
          @if(Auth::user()->id == $user->id || Auth::user()->is_admin()) 
            <div class="avatar-buttons">
                <form enctype="multipart/form-data" action="/cover" method="POST">
                  <div class="form-group">
                    <input type="file" name="cover" id="cover" class="inputfile" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="Update" class="btn btn-sm btn-primary submit">
                  </div>
                </form>
            </div>
           @endif
  </div>
  </div> <!-- Row -->

  </div><!--Container -->

@endsection
