@extends('layouts.app')

@section('content')
<div class="container">
<!-- New Register Form -->
<div class="row">
    <div class="col-md-12">
        <h1 class="login-header" style="text-align: center;">Sign Up Below:</h1>
    </div>
</div>
<div style="  background-color: #f6f9fb; border-radius:3px; padding:10px; margin:0px auto; width:400px; text-align:center; padding:25px; margin-bottom:20px; border:1px solid #e5e5e5">

    <img src="/uploads/signup-icon.png" style="width:100px; margin:0px auto; margin-bottom:40px; background:rgba(0, 0, 0, 0.05); border-radius:50px; border:1px solid #e5e5e5" class="animated fadeIn">

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="name" placeholder="Name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="email"  placeholder="Email Address" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12">
                                <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                          <button type="submit" style="width:100%;" class="btn btn-primary btn-teal">
                            Sign Up
                        </button>
                    </form>

</div><!-- End Login Background Div -->

<!-- End New Form -->

</div>
@endsection
