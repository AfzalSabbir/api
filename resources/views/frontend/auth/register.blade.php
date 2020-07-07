@extends('frontend.layouts.auth')

@section('fav_title', __('backend/default.user_register'))

@section('content')
  <!-- .auth -->
  <main class="auth">
    <header id="auth-header" class="auth-header" style="background-image: url({{ asset('public/images/illustration/img-1.png') }});">
      <h1>
          <a href="{{ route('home') }}" title="Home"><img width=168 src="{{ asset('public/images/BoiNaw.jpg') }}" alt="" /></a><span class="sr-only">{{ __('backend/default.sign_up') }}</span>
      </h1>
      <p> {{ __('backend/default.already_have_an_account') }}? {{ __('backend/default.please') }} <a href="{{ route('login') }}">{{ __('backend/default.sign_in') }}</a>
      </p>
    </header>
    {{-- @dd($errors->all(), session()->getOldInput()) --}}
    <form-register
      url_register = "{{ route('register') }}"
      url_validate = "{{ route('axios.validate') }}"

      old_inputs  = "{{ count(session()->getOldInput()) > 0 ? 1:0 }}"
      form_errors = "{{ json_encode($errors->any() ? $errors->all():0) }}"
    >
      @csrf
    </form-register>

    {{-- <footer class="auth-footer"> &copy; 2018 All Rights Reserved. </footer> --}}

    @include('frontend.partials.footer.footer-register')

  </main><!-- /.auth -->
@endsection
