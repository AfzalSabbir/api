<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{--
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css') }}">
  --}}

  @php
    $site_setting = \App\Models\Setting::first();
  @endphp

  <title>{{ Config::get('app.locale') == 'en' ? ucwords($site_setting->title_en) : $site_setting->title_bn }} - {{ __('backend/default.sign_in') }}</title>
  <style>
    .login-content .login-box,
    .login-content .logo {
    min-width: 420px !important;
      /* min-width: 360px !important; */
    }
    .login-box {
      background-color: #00000060 !important;
    }
    .login-content {
      background: url({{ asset(env('LOGIN_IMAGE')).rand(1,5).'.jpg' }}) no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
    .monospace {
      font-family: monospace;
    }
    .logo {
      margin-bottom: 0!important;
      text-align: center;
    }
    .logo > h1 {
      color: var(--nav-primary);
      display: none;
    }
    label,
    a:hover {
      color: #fff !important;
    }
  </style>
  @include('backend.partials.head')
  @include('backend.partials.styles')
</head>


<body>
<section class="{{-- material-half-bg --}}">
  <div class="cover"></div>
</section>
<section class="login-content">
  <div class="logo">
    <h1>{{ env('APP_NAME') }}</h1>
    @if ( Session::has('login_error') )
      <div class="alert alert-danger monospace text-left">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! Session::get('login_error') !!}
      </div>
    @endif
  </div>
  <div class="login-box br-4">
    {{-- <div style="background: #ffffff80;width: 65px;height: 64px;text-align: center;border-radius: 50%;border: 5px solid #00000080;padding-bottom: 50px;position: absolute;left: calc((100% - 64px)/2);top: -32px;"><i style="color: #fff;padding-top: 10px;border-radius: 50%;" class="fa fa-lg fa-fw fa-user fa-3x"></i></div> --}}
    <form class="login-form" action="{!! route('admin.login.submit') !!}" method="post">
      @csrf
      <h3 class="login-head text-white"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>

      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif
      <div class="form-group my-4">
        <label class="control-label">{{ __('backend/default.username') }}</label>
        <input class="form-control" type="text" value="{{ (request()->token) ? \App\Helpers\LoginHelper::get_username(request()->token) : '' }}" placeholder="Username" name="username" autofocus required>
      </div>
      <div class="form-group my-4">
        <label class="control-label">{{ __('backend/default.password') }}</label>
        <input class="form-control" type="password" value="{{ (request()->token) ? \App\Helpers\LoginHelper::get_password(request()->token) : '' }}" placeholder="Password" name="password" required>
      </div>
      <div class="form-group">
        <div class="utility">
          <div class="animated-checkbox">
            <label>
              {{--<input type="checkbox"><span class="label-text">Stay Signed in</span>--}}
              <button class="btn btn-primary" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
            </label>
          </div>
          <p class="semibold-text mb-2 text-white"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
        </div>
      </div>
      {{--<div class="form-group btn-container">--}}
        {{--<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>--}}
      {{--</div>--}}
    </form>
    <form class="forget-form" action="{{ route('admin.password.email') }}" method="post">
      @csrf
      <h3 class="login-head text-white"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
      <div class="form-group">
        <label class="control-label">EMAIL</label>
        <input class="form-control" type="text" placeholder="Email" name="email" required>
      </div>
      <div class="form-group btn-container">
        <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
      </div>
      <div class="form-group mt-3">
        <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
      </div>
    </form>
  </div>
</section>

<script src="{{ asset('public/backend/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('public/backend/js/popper.min.js') }}"></script>
<script src="{{ asset('public/backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/backend/js/main.js') }}"></script>
<script src="{{ asset('public/backend/js/plugins/pace.min.js') }}"></script>
<script type="text/javascript">
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });
    @if(request()->token)
      if (!$('.logo div.alert-danger').children('a').hasClass('close')) {
        $(".utility button").text("Logging in...");
        $(".utility button").click();
      } else {
        $(".utility button").text("{{ __('backend/default.sign_in') }}");
      }
    @endif
</script>
</body>
</html>
