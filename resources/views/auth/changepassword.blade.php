@extends('layouts.app')
@section('content')


<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <div class="x_panel">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                    <h1>Change password</h1>
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <input id="current-password" type="password" class="form-control" name="current-password" required placeholder="Current Password">
                        @if ($errors->has('current-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('current-password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <input id="new-password" type="password" class="form-control" name="new-password" required placeholder="New Password">
                        @if ($errors->has('new-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new-password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required placeholder="Confirm New Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>

</div>


@endsection

