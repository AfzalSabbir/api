@extends('frontend.layouts.auth')

@section('fav_title', __('backend/default.user_login'))

@section('content')
    <!-- .auth -->
    <main class="auth">
      <header id="auth-header" class="auth-header"><meta charset="gb18030">
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
        @php
          // dd(Captcha::create());
          $captcha = json_decode(file_get_contents(asset("captcha/api/math")));
          // dd($captcha->img);
        @endphp
        <div class="form-group d-flex">
          <input name="key" type="hidden" value="{{ $captcha->key }}" required="">
          <img src="{{ $captcha->img }}" alt="captcha"> <input name="captcha" type="text" required="" class="w-100">
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('backend/default.sign_in') }}</button>
        </div><!-- /.form-group -->
      </form><!-- /.auth-form -->
    </main><!-- /.auth -->
@endsection
