@extends('layouts.main.index')
@section('title', 'Home Page')
@section('page-title', 'Please Login')
@section('content')
  <div class="row">
    <div class="col">
      <p class="lead text-center mt-5 mb-5">
        This app is restricted and only available to registered user <br>
        Login to start using it.<br>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <a class="btn btn-lg btn-primary btn-block" href="{{ route('admin.login') }}">Login</a>
    </div>
  </div>

@endsection
