@extends('frontend.layouts.auth')

@section('fav_title', __('backend/default.user_login'))

@section('content')
    <!-- .auth -->
    <main class="auth">
      <header id="auth-header" class="auth-header" style="background-image: url({{ asset('public/images/illustration/img-1.png') }});"><meta charset="gb18030">
        <h1>
            <a href="{{ route('home') }}" title="Home"><img width=168 src="{{ asset('public/images/BoiNaw.jpg') }}" alt="" /></a><span class="sr-only">Login</span>
        </h1>
        <p> {{ __('backend/default.don\'t_have_an_account') }}? <a href="{{ route('register') }}">{{ __('backend/default.create_one') }}</a>
        </p>
      </header>
      <!-- form -->
      <form class="auth-form" method="POST" action="{{ route('login') }}">
        @csrf
        @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">×</button>{!! Session::get('message') !!}</p>
        @endif
        @if($errors->any())
          @foreach ($errors->all() as $error)
            <p class="alert alert-info alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">×</button>{!! $error !!}</p>
          @endforeach
        @endif
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" id="inputUser" value="{{ !empty(request()->signup) && !empty(request()->ref) ? decrypt(request()->ref):'' }}" class="form-control" name="username" placeholder="{{ __('backend/default.username') }}" autofocus=""> <label for="inputUser">{{ __('backend/default.username') }}</label>
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="{{ __('backend/default.password') }}"> <label for="inputPassword">{{ __('backend/default.password') }}</label>
            Password: 12345678
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('backend/default.sign_in') }}</button>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group text-center">
          <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remember-me"> <label class="custom-control-label" for="remember-me">{{ __('backend/default.keep_me_sign_in') }}</label>
          </div>
        </div><!-- /.form-group -->
        <!-- recovery links -->
        <div class="text-center pt-0">
          <a href="{{ route('user.showRecoverForm') }}" class="link">{{ __('backend/default.forgot_username') }}?</a> <span class="mx-2">·</span> <a href="{{ route('user.showResetForm') }}" class="link">{{ __('backend/default.forgot_password') }}?</a>
        </div><!-- /recovery links -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="text-muted"><div class="log-divider"><span class="bg-light">{{ __('backend/default.or') }}</span></div></div>
        </div><!-- /.form-group -->
        <div class="btn-group d-flex">
          <a href="{{ route('socialite.facebook') }}" class="btn btn-lg text-white box-shadow" style="background: #3f5aa9"><i class="fab fa-facebook-f" style="width: 20px;"></i></a>
          <a href="{{ route('socialite.google') }}" class="btn btn-lg text-white box-shadow" style="background: #e44134"><i class="fab fa-google" style="width: 20px;"></i></a>
          <a href="{{ route('socialite.github') }}" class="btn btn-lg btn-dark box-shadow"><i class="fab fa-github" style="width: 20px;"></i></a>
        </div>
        {{-- <div class="form-group">
          <a href="{{ route('socialite.facebook') }}" class="btn btn-lg btn-block text-white box-shadow rounded-sm text-left" style="background: #3f5aa9"><i class="fab fa-facebook-f" style="width: 20px;"></i>Sign in with Facebook</a>
          <a href="{{ route('socialite.google') }}" class="btn btn-lg btn-block text-white box-shadow rounded-sm text-left" style="background: #e44134"><i class="fab fa-google" style="width: 20px;"></i>Sign in with Google</a>
          <a href="{{ route('socialite.github') }}" class="btn btn-lg btn-dark btn-block box-shadow rounded-sm text-left"><i class="fab fa-github" style="width: 20px;"></i>Sign in with Github</a>
        </div> --}}
      </form><!-- /.auth-form -->

      @include('frontend.partials.footer.footer-login')
    </main><!-- /.auth -->
@endsection
