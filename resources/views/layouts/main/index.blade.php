<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  @include('layouts.main._head')
  <body>
    @include('layouts.main._menu')
    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          @include('layouts.main._sidebar')
        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <div class="">
            <h1 class="bg-faded p-3">@yield('page-title')</h1>
          </div>
          {{-- Errors Managing System --}}
          @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
              <strong>Success:</strong> {{ session()->get('success') }}
            </div>
          @endif
          @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <strong>Errors:</strong>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
            </div>
          @endif
          @if (session('status'))
            <div class="alert alert-info">
              {{ session('status') }}
            </div>
          @endif
          @if (session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
          @endif

          @yield('content')
        </main>
      </div>
    </div>
    @include('layouts.main._footer')
    @include('layouts.main._scripts')
  </body>
</html>
