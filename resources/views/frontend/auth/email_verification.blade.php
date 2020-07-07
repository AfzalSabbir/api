@extends('frontend.layouts.auth')

@section('fav_title', 'Email Verification')

@section('styles')
<style>
  .auth, body{
    background-color: #fff;
  }
</style>
@endsection

@section('content')

    <main class="auth">
      <!-- form -->
      @if(!session()->get('verification_time_error') && !session()->get('already_verified'))
      <form action="{{ route('emailVerification', encrypt($token)) }}" class="hide-to-resend auth-form auth-form-reflow mt-5" method="POST">
        @csrf
        <div class="text-center mb-4">
          <div class="mb-4">
            <a href="{{ route('home') }}" title="Home"><img width="168" src="{{ asset('public/images/icon/jpg/boinaw-white-primary.jpg') }}" alt=""></a>
          </div>
          <h1 class="h3 text-primary"> {{ __('backend/default.email_verification') }} </h1>
        </div>

        @if(session()->get('verification_code_error'))
          <p class="mb-4 list-group-item-action list-group-item-danger pl-3 bg-light py-1 pr-1"> The code you've entered mismatches which we've sent you <abbr title="Only the last code is verifiable">last</abbr>. Check your spam folder or all mail.<br />Else click <a class="showResendForm" href="#" @click.prevent>Resend</a> another code </p>
        @else
          <p class="mb-4 list-group-item-action list-group-item-info pl-3 bg-light py-1 pr-1"> A email verification code has sent to your email. Enter the code below. If you have verified your email already then <a href="{{ route('login') }}">login</a> or <a class="showResendForm" href="#" @click.prevent>Resend</a> a verification code.</p> </p>
        @endif

        <div id="recovery-mode" class="card-expansion">
          @if($errors->any())
            @foreach ($errors->all() as $alert=> $error)
              <p class="alert {{ Session::get('alert-class', 'alert-warning') }} alert-dismissible mb-0 fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>{!! $error !!}</p>
            @endforeach
          @endif
          <!-- .card-expansion-item -->
          <div class="card card-reflow card-expansion-item expanded mt-0">
            <div id="matchCode" class="collapse show" aria-labelledby="emailMatchCode" data-parent="#recovery-mode" style="">
              <div class="card-body p-0">
                <input type="text" name="emailCode" class="form-control form-control-lg {{ session()->get('verification_code_error') ? 'border-danger':'' }}" placeholder="{{ __('backend/default.code') }}">
                <code>Every code expires after 3hrs!</code>
              </div>
            </div>
          </div><!-- /.card-expansion-item -->
          <!-- .card-expansion-item -->
          {{-- <div class="card card-reflow card-expansion-item">
            <div class="card-header px-0 border-0" id="recoverByMobile">
              <button type="button" class="btn btn-reset collapsed" data-toggle="collapse" data-target="#byMobile" aria-expanded="false" aria-controls="byMobile"><span class="collapse-indicator mr-2"><i class="far fa-lg fa-circle"></i></span> <strong>Recover using your mobile number</strong></button>
            </div>
            <div id="byMobile" class="collapse" aria-labelledby="recoverByMobile" data-parent="#recovery-mode" style="">
              <div class="card-body pt-0 pl-5">
                <!-- .form-group -->
                <div class="form-group mb-4">
                  <select name="inputCountry" class="custom-select custom-select-lg">
                    <option value="" disabled=""> Select Country </option>
                    <option value="+880" selected> +880 </option>
                  </select>
                </div><!-- /.form-group -->
                <!-- .form-group -->
                <div class="form-group mb-4">
                  <label class="d-block text-left" for="inputMobile">Mobile Number</label> <input type="text" id="inputMobile" name="inputMobile" class="form-control form-control-lg">
                </div><!-- /.form-group -->
              </div>
            </div>
          </div> --}}<!-- /.card-expansion-item -->
        </div><!-- /Expansion Cards -->
        <!-- actions -->
        <div class="d-block d-md-inline-block mb-2">
          <button class="btn btn-lg btn-block btn-primary" type="submit">{{ __('backend/default.verify') }}</button>
        </div>

        <div class="d-block d-md-inline-block">
          <a href="{{ route('login') }}" class="btn btn-block btn-light">{{ __('backend/default.return_to_signin') }}</a>
        </div>
        <div class="d-block d-md-inline-block">
          <a href="{{ route('home') }}" class="btn btn-block btn-light">{{ __('backend/default.home') }}</a>
        </div>
      </form><!-- /.auth-form -->
      @elseif(session()->get('verification_time_error'))
        <div class="hide-to-resend auth-form auth-form-reflow mt-5">
          <div class="text-center mb-4">
            <div class="mb-4">
              <a href="{{ route('home') }}" title="Home"><img width="168" src="{{ asset('public/images/icon/jpg/boinaw-white-primary.jpg') }}" alt=""></a>
            </div>
            <h1 class="h3 text-primary"> {{ __('backend/default.link_expired') }} </h1>
          </div>
          <p class="mb-4 list-group-item-action list-group-item-info pl-3 bg-light py-1 pr-1">Your code has expired. <a class="showResendForm" href="#" @click.prevent>Resend</a> a verification code and remember that, it will be available for <strong>3hrs</strong>!</p>
        </div>
      @elseif(session()->get('already_verified'))
        <div class="hide-to-resend auth-form auth-form-reflow mt-5">
          <div class="text-center mb-4">
            <div class="mb-4">
              <a href="{{ route('home') }}" title="Home"><img width="168" src="{{ asset('public/images/icon/jpg/boinaw-white-primary.jpg') }}" alt=""></a>
            </div>
            <h1 class="h3 text-primary"> {{ __('backend/default.email_verified') }} </h1>
          </div>
          <p class="mb-4 list-group-item-action list-group-item-info pl-3 bg-light py-1 pr-1"> Your email is already verified successfully!<br /><a href="{{ route('login') }}">Login</a> here and feel free to <strong>share</strong> your book, <strong>get</strong> one or <strong>wish</strong> one using <a href="{{ route('home') }}" title="">BoiNaw</a>.</p>
        </div>
      @endif


      <div class="show-to-resend auth-form auth-form-reflow mt-5" style="display: none;">
        <div class="text-center mb-4">
          <div class="mb-4">
            <a href="{{ route('home') }}" title="Home"><img width="168" src="{{ asset('public/images/icon/jpg/boinaw-white-primary.jpg') }}" alt=""></a>
          </div>
          <h1 class="h3 text-primary"> {{ __('backend/default.resend_code') }} </h1>
        </div>
        <form action="{{ route('mail.emailVerification') }}" method="post" accept-charset="utf-8">
          @csrf
          <div id="recovery-mode" class="card-expansion">
            @if($errors->any())
              @foreach ($errors->all() as $alert=> $error)
                <p class="alert {{ Session::get('alert-class', 'alert-warning') }} alert-dismissible mb-0 fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>{!! $error !!}</p>
              @endforeach
            @endif
            <!-- .card-expansion-item -->
            <div class="card card-reflow card-expansion-item expanded mt-0">
              <div id="matchCode" class="collapse show" aria-labelledby="emailMatchCode" data-parent="#recovery-mode" style="">
                <div class="card-body p-0">
                  <input type="email" name="email" class="form-control form-control-lg" placeholder="{{ __('backend/default.email') }}">
                  <code>Every code expires after 3hrs!</code>
                </div>
              </div>
            </div><!-- /.card-expansion-item -->
          </div><!-- /Expansion Cards -->
          <!-- actions -->
          <div class="d-block d-md-inline-block mb-2">
            <button class="btn btn-lg btn-block btn-primary" type="submit">{{ __('backend/default.send') }}</button>
          </div>

          <div class="d-block d-md-inline-block">
            <a href="{{ route('login') }}" class="btn btn-block btn-light">{{ __('backend/default.return_to_signin') }}</a>
          </div>
          <div class="d-block d-md-inline-block">
            <a href="{{ route('home') }}" class="btn btn-block btn-light">{{ __('backend/default.home') }}</a>
          </div>
        </form>
      </div>

      @include('frontend.partials.footer.footer-login')
      @php
        session()->forget('verification_time_error');
        session()->forget('verification_code_error');
      @endphp
    </main>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {
    $('.showResendForm').click(function(){
      $('.show-to-resend').show();
      $('.hide-to-resend').hide();
    })
  });
</script>
@endsection