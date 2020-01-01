@extends('layouts.app')

@section('content')

<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <div class="x_panel">
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <h1>Login Form</h1>
                    <div  class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <!--<input type="text" class="form-control"required="" />-->
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus  placeholder="Username" >
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div  class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" required  placeholder="Password" >
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                    <div>

                        <button type="submit" class="btn btn-default submit">
                            Login
                        </button>

                        <button type="button" class="btn btn-default submit"  onclick="location.href='{{ route('password.request') }}'">
                            Forgot Your Password?
                        </button>
                    </div>

                    <div class="clearfix"></div>

                </form>
            </div>
        </section>
    </div>

</div>

@endsection


