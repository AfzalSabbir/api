@extends('frontend.layouts.auth')

@section('fav_title', 'Set New Password')

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
        <form
          action=""
          method="post"
          class="auth-form auth-form-reflow"
          onsubmit="return mySubmitFunction(event)"
          >
          @csrf
          @if(!is_null($data))
          <div class="text-center mb-4">
            <div class="mb-4">
              <a href="{{ route('home') }}" title="Home"><img width="168" src="{{ asset('public/images/icon/jpg/boinaw-white-primary.jpg') }}" alt=""></a>
            </div>
            <h1 class="h3 text-primary"> Set New Password </h1>
          </div>
          @if ($errors->any())
            <ul class="alert alert-danger list-unstyled">
              @foreach($errors->all() as $error)
              <li>
                {{ $error }}
              </li>
              @endforeach
            </ul>
          @endif
          <div class="form-group mb-3">
            <label class="d-block text-left h6" for="inputUser">Username</label> <span type="text" id="inputUser" class="form-control form-control-lg bg-light" required="">{{ $data->username }}</span>
          </div>
          <div class="form-group mb-2">
            <label class="d-block text-left h6" for="inputNewPass">New Password</label> <input type="password" id="inputNewPass" class="form-control form-control-lg" required="" autofocus="on" minlength="8" name="password">
          </div>
          <div class="form-group mb-2">
            <label class="d-block text-left h6" for="inputConfPass">Confirm Password</label> <input type="password" id="inputConfPass" class="form-control form-control-lg" required="" minlength="8" name="password_confirmation">
          </div>
          <!-- actions -->
          <div class="d-block d-md-inline-block mb-2">
            <button class="btn btn-lg btn-block btn-primary" type="submit">Reset Password</button>
          </div>
          <div class="d-block d-md-inline-block">
            <a href="{{ route('login') }}" class="btn btn-block btn-light">Return to signin</a>
          </div>
          <div class="d-block d-md-inline-block">
            <a href="{{ route('home') }}" class="btn btn-block btn-light">Home</a>
          </div>
          @else

          <div class="text-center mb-4 mt-md-5 pb-2">
            <div class="mb-4">
              <a href="{{ route('home') }}" title="Home"><img width="168" src="{{ asset('public/images/icon/jpg/boinaw-white-black.jpg') }}" alt=""></a>
            </div>
          </div>

          <div class="alert alert-dark mt-md-5"><h3>Link Expired</h3><br /><a class="font-weight-bolder text-gray-dark" href="{{ route('user.showResetForm') }}" title="Get another reset password link">Click here</a> to go to password reset page.<br /><small class="text-muted font-weight-bold">Remember that a password reset link expires in 3 hrs!</small></div>
          @endif
        </form><!-- /.auth-form -->
        <footer class="auth-footer mt-5"> © 2018 All Rights Reserved. <a href="{{ route('home') }}" title="Username Recovery">Boinaw</a> is Responsive Admin Theme build on top of latest Bootstrap 4. <a href="#">Privacy</a> and <a href="#">Terms</a>
        </footer>
    </main>
@endsection
@section('scripts')
<script>
  function mySubmitFunction(e){
    console.log(document.getElementById('inputNewPass').value, document.getElementById('inputConfPass').value);
    if(document.getElementById('inputNewPass').value != document.getElementById('inputConfPass').value) {
      e.preventDefault();
      alert('Confirm password mismatched!')
    }
  }
</script>
@endsection
