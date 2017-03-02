@extends('layouts.app')

@section('content')

<div id="subheader" class="all-books" style="background-image: url(/uploads/reading_list-bg.jpg);">
  <div class="bg-gradient"></div>
  <div class="logo">
    <h1>Reading List</h1>
    <p>Add your favorite books to your reading list below for everyone to see on your profile!</p>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
          <div class="add-reading-list">
          <h3>Add Books to your Reading List </h3>
            <form action="{{ route('store-task') }}" method="post" class="form-horizontal">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="col-md-3 control-label">Book Name</label>
                    
                  <div class="col-md-6">
                    <input type="text" name="name" id="name" class="form-control">
                      
                      @if($errors->has('name'))
                          <div class="help-block">
                              Book Name is required, and cannot be more than 255 characters in length.
                          </div>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-offset-3 col-md-6">
                    <button type="submit" class="btn btn-default btn-teal pull-right">Add Book</button>
                  </div>
                </div>
                {{ csrf_field() }}
            </form>
          </div>
    </div>
  </div> <!-- END FIRST ROW -->

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3>Reading List</h3>
              @if($tasks->count())
                    @foreach($tasks as $task)
                    <div class="reading-list-item">
                      <form action="{{ route('delete-task', $task->id) }}" method="post">
                        <p><i class="fa fa-bookmark-o" aria-hidden="true"></i> {{ $task->name }} 
                             <button type="submit" class="btn btn-danger btn-red pull-right">Delete</button>
                             {{ method_field('DELETE') }}
                             {{ csrf_field() }}
                        </form>
                      </p>
                    </div>
                   @endforeach
              @else
                <h3>You have no books on your reading list!</h3>
              @endif
    </div>
  </div> <!-- END SECOND ROW -->

</div>

@endsection
