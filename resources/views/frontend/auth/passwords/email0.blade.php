@extends('frontend.layouts.auth')

@section('fav_title', 'Password Reset')

@section('content')
<!-- .auth -->
<main class="auth">
	<header id="auth-header" class="auth-header" style="background-image: url({{ asset('public/images/illustration/img-1.png') }});">
		<h1>
			<a href="{{ route('home') }}" title="Home"><img width=168 src="{{ asset('public/images/BoiNaw.jpg') }}" alt="" /></a><span class="sr-only">Email - Password Reset</span>
		</h1>
		<p>
			Don't have a account? <a href="{{ route('register') }}">Create One</a>
			<br />
			<span>-</span> Or <span>-</span>
			<br />
			Already have one! <a href="{{ route('login') }}">Log In</a>
		</p>
	</header>
	<!-- form -->
	<form class="auth-form" method="POST" action="{{ route('login') }}">
		@csrf


        <div class="form-group row">
            <div class="col-12">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <div class="col-md-8 mx-auto text-center">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </div>

	</form><!-- /.auth-form -->
	<!-- copyright -->
	<footer class="auth-footer"> © 2018 All Rights Reserved. <a href="#">Privacy</a> and <a href="#">Terms</a>
	</footer>
</main><!-- /.auth -->
@endsection