@extends('layouts.app')

@section('content')

<div class="container">
<h3>Update Avatar</h3>
  <div class="row">
    <div class="col-md-12 profile-image avatar">
            <div class="avatar-details">
                <h3>{{ $user->name }}'s Profile Photo</h3>
                <img src="/uploads/avatars/{{ $user->avatar }}">
                <p>Simply choose an image for your profile photo below, and once selected, hit the 'Update' button.</p>
            </div>
            @if(Auth::user()->id == $user->id || Auth::user()->is_admin()) 
            <div class="avatar-buttons">
                <form enctype="multipart/form-data" action="/avatar" method="POST">
                  <div class="form-group">
                    <input type="file" name="avatar" id="avatar" class="inputfile" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="Update" class="btn btn-sm btn-primary submit">
                  </div>
                </form>
            </div>
           @endif
      </div>
  </div>
</div>


@endsection
