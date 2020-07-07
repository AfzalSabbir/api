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
      <form-reset-password
        mail_password_reset   = "{{ route('mail.passwordReset') }}"
        user_show_recover_form = "{{ route('user.showRecoverForm') }}"
        home                = "{{ route('home') }}"
        login               = "{{ route('login') }}"
      >
        @csrf
      </form-reset-password>
        {{-- @dd(route('mail.passwordReset')) --}}

      @include('frontend.partials.footer.footer-login')
    </main>
@endsection