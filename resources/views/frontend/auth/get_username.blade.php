@extends('frontend.layouts.auth')

@section('fav_title', 'Password Reset')

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
      <form action="{{ route('mail.recoverUsername') }}" class="auth-form auth-form-reflow" method="POST">
        @csrf
        <div class="text-center mb-4">
          <div class="mb-4">
            <a href="{{ route('home') }}" title="Home"><img width="168" src="{{ asset('public/images/icon/jpg/boinaw-white-primary.jpg') }}" alt=""></a>
          </div>
          <h1 class="h3 text-primary"> {{ __('backend/default.recover_your_username') }} </h1>
        </div>
        <p class="mb-4 list-group-item-action list-group-item-info pl-3 bg-light py-1 pr-1"> Enter your email below to get your username through mail to your given email. Never share your personal information to anyone. </p>

        <div id="recovery-mode" class="card-expansion">
          @if($errors->any())
            @foreach ($errors->all() as $alert=> $error)
              <p class="alert {{ Session::get('alert-class', 'alert-warning') }} alert-dismissible mb-0 fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>{!! $error !!}</p>
            @endforeach
          @endif
          <!-- .card-expansion-item -->
          <div class="card card-reflow card-expansion-item expanded mt-0">
            <div class="card-header px-0 border-0" id="recoverByEmail">
              <button type="button" class="btn btn-reset" data-toggle="collapse" data-target="#byEmail@@@" aria-expanded="true" aria-controls="byEmail"><span class="collapse-indicator mr-2"><i class="far fa-lg fa-circle"></i></span> <strong>{{ __('backend/default.recover_using_your_email_address') }}</strong></button>
            </div>
            <div id="byEmail" class="collapse show" aria-labelledby="recoverByEmail" data-parent="#recovery-mode" style="">
              <div class="card-body pt-0 pl-0 pr-0">
                <input type="email" name="recoverEmail" class="form-control form-control-lg" placeholder="{{ __('backend/default.Ex:') }} user@boinaw.com">
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
          <button class="btn btn-lg btn-block btn-primary" type="submit">{{ __('backend/default.recover_username') }}</button>
        </div>

        <div class="d-block d-md-inline-block">
          <a href="{{ route('login') }}" class="btn btn-block btn-light">{{ __('backend/default.return_to_signin') }}</a>
        </div>
        <div class="d-block d-md-inline-block">
          <a href="{{ route('home') }}" class="btn btn-block btn-light">{{ __('backend/default.home') }}</a>
        </div>
      </form><!-- /.auth-form -->

      @include('frontend.partials.footer.footer-login')
    </main>
@endsection