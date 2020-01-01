@extends('layouts.app')

@section('content')

<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <div class="x_panel">
                <form  method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <h1>Reset Password</h1>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="E-Mail Address">
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="btn btn-default submit">
                            Send Password Reset Link
                        </button>
                    </div>

                    <div class="clearfix"></div>

                </form>
            </div>
        </section>
    </div>

</div>

@endsection

