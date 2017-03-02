@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
    <div class="col-md-12">
        <h1 class="login-header" style="text-align: center;">Please Login Below:</h1>
    </div>
</div>
<div style="  background-color: #f6f9fb; border-radius:3px; padding:10px; margin:0px auto; width:400px; text-align:center; padding:25px; margin-bottom:20px; border:1px solid #e5e5e5">
                        
                        <img src="/uploads/login-icon.png" style="width:100px; margin:0px auto; margin-bottom:40px; background:rgba(0, 0, 0, 0.05); border-radius:50px; border:1px solid #e5e5e5" class="animated fadeIn">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="email" placeholder="Email Address" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                    </label>
                                </div>
                        </div>
                        
                        <div class="button">
                            <button type="submit" style="width: 100%" class="btn btn-primary btn-teal">
                                    Sign In
                            </button>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a class="btn btn-link" href="{{ url('/register') }}">
                                    or Sign Up
                                </a>
                            </div>
                        </div>
                    </form>
</div>



</div> <!-- End Container Div -->
@endsection
