@extends('frontend.layouts.auth')

@section('fav_title', __('backend/default.user_login'))

@section('content')
    <!-- .auth -->
    <main class="auth">
      <header id="auth-header" class="auth-header"><meta charset="gb18030">
        <p>
          <a href="{{ route('api_logout') }}">{{ __('backend/default.logout') }}</a>
        </p>
      </header>
      <div class="container">
        <div class="row">
          <div class="col-md-4 offset-md-4 bg-light py-3 rounded">
            <ul>
              <li>Name : {{ Auth::guard('admin')->user()->name }}</li>
              <li>Email : {{ Auth::guard('admin')->user()->email }}</li>
              <li>Phone : {{ Auth::guard('admin')->user()->mobile }}</li>
              <li>Country : {{ ucfirst(Auth::guard('admin')->user()->country) }}</li>
              <li>Division : {{ ucfirst(Auth::guard('admin')->user()->division) }}</li>
            </ul>
          </div>
        </div>
      </div>

    </main><!-- /.auth -->
@endsection
