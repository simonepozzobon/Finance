@extends('layouts.main.index')
@section('title', 'Admin Login')
@section('page-title', 'Admin Login')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="card">
              <div class="card-block">
                <div class="card-text">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">
                      {{ csrf_field() }}
                      {{ method_field('POST') }}
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email">E-Mail Address</label>
                          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password">Password</label>
                          <input id="password" type="password" class="form-control" name="password" required>
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="form-group">
                          <div class="checkbox">
                              <label>
                                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                              </label>
                          </div>
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block">
                              Login
                          </button>
                      </div>

                      <div class="form-group">
                          <a class="" href="{{ route('password.request') }}">Forgot Your Password?</a>
                      </div>
                  </form>
                </div>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
