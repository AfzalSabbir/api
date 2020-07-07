<!-- Full Structure -->
@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.profile'))

<!-- Write Styles <style>In Here</style> -->
@section('styles')
  <style>
    input, select, textarea,
    .custom-file-label, .custom-control-input,
    .custom-control-label:before, .custom-control-label:before {
      border-radius: 0px !important;
    }
  </style>
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
	{{-- @include('frontend.partials.profile.profile_banner') --}}
  @include('frontend.partials.profile.profile_nav')
  <!-- .page-inner -->
  <div class="page-inner pt-2 pb-0">
    <div class="container">
      <!-- .page-title-bar -->
      {{-- <header class="page-title-bar mb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">
              <a href="{{ route('profile') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i> {{ __('backend/default.overview') }} </a>
            </li>
          </ol>
        </nav>
      </header> --}}<!-- /.page-title-bar -->
      <!-- .page-section -->
      <div class="page-section">
        <!-- grid row -->
        <div class="row">

          <!-- grid column -->
          <div class="col-lg-3">
            @include('frontend.partials.profile.profile_setting_sidebar')
          </div><!-- /grid column -->

          <!-- grid column -->
          <div class="col-lg-3">
            @include('frontend.partials.profile.profile_setting_midbar')
          </div><!-- /grid column -->

          <!-- grid column -->
          <div id="profile_setting_container" class="col-lg-6">

            <!-- .card -->
            <div id="profile_personal" class="card card-fluid radius-0 border-primary box-shadow" style="display: none;">
              <div class="card-header border-0 bg-primary text-white rounded-0 py-2">
                <a class="card-title mb-0"><i class="fad fa-user-lock"></i> {{ __('backend/default.personal_profile') }} </a>
              </div>
              <!-- .card-body -->
              <profile-personal-info
                url_register = "{{ route('register') }}"
                url_validate = "{{ route('auth.axios.validate') }}"

                old_inputs  = "{{ count(session()->getOldInput()) > 0 ? 1:0 }}"
                form_errors = "{{ json_encode($errors->any() ? $errors->all():0) }}"
              ></profile-personal-info><!-- /.card-body -->
            </div><!-- /.card -->


            <!-- .card -->
            <div id="profile_profile" class="card card-fluid radius-0 border-primary box-shadow" style="display: none;">
              <div class="card-header border-0 bg-primary text-white rounded-0 py-2">
                <a class="card-title mb-0"><i class="fad fa-user-tie"></i> {{ __('backend/default.public_profile') }} </a>
              </div>
              <!-- .card-body -->
              <profile-basic-info
                url_register = "{{ route('register') }}"
                url_validate = "{{ route('auth.axios.validate') }}"

                old_inputs  = "{{ count(session()->getOldInput()) > 0 ? 1:0 }}"
                form_errors = "{{ json_encode($errors->any() ? $errors->all():0) }}"
              ></profile-basic-info><!-- /.card-body -->
            </div><!-- /.card -->

            <!-- .card -->
            <div id="profile_password" class="card card-fluid radius-0 border-primary box-shadow" style="display: none;">
              <div class="card-header border-0 bg-primary text-white rounded-0 py-2">
                <a class="card-title mb-0"><i class="fad fa-key"></i> {{ __('backend/default.change_password') }} </a>
              </div>
              <!-- .card-body -->
              <profile-password-change
                url_register = "{{ route('register') }}"
                url_validate = "{{ route('auth.axios.validate') }}"

                old_inputs  = "{{ count(session()->getOldInput()) > 0 ? 1:0 }}"
                form_errors = "{{ json_encode($errors->any() ? $errors->all():0) }}"
              ></profile-password-change><!-- /.card-body -->
            </div><!-- /.card -->

            <!-- .card -->
            <div id="profile_social" class="card card-fluid radius-0 border-primary box-shadow" style="display: none;">
              <div class="card-header border-0 bg-primary text-white rounded-0 py-2">
                <a class="card-title mb-0"><i class="fad fa-id-card-alt"></i> {{ __('backend/default.social_profile') }} </a>
              </div>
              <form method="post">
                <!-- .list-group -->
                <div class="list-group list-group-flush mt-3 mb-0">
                  <!-- .list-group-item -->
                  <div class="list-group-item">
                    <!-- .list-group-item-figure -->
                    <div class="list-group-item-figure">
                      <div class="tile tile-md bg-twitter rounded-0">
                        <i class="fab fa-twitter"></i>
                      </div>
                    </div><!-- /.list-group-item-figure -->
                    <!-- .list-group-item-body -->
                    <div class="list-group-item-body">
                      <input type="text" class="form-control" id="twitter" placeholder="Twitter Username" value="@stilearningTwit">
                    </div><!-- /.list-group-item-body -->
                  </div><!-- /.list-group-item -->
                  <!-- .list-group-item -->
                  <div class="list-group-item">
                    <!-- .list-group-item-figure -->
                    <div class="list-group-item-figure">
                      <div class="tile tile-md bg-facebook rounded-0">
                        <i class="fab fa-facebook-f"></i>
                      </div>
                    </div><!-- /.list-group-item-figure -->
                    <!-- .list-group-item-body -->
                    <div class="list-group-item-body">
                      <input type="text" class="form-control" id="facebook" placeholder="Facebook Username">
                    </div><!-- /.list-group-item-body -->
                  </div><!-- /.list-group-item -->
                  <!-- .list-group-item -->
                  <div class="list-group-item">
                    <!-- .list-group-item-figure -->
                    <div class="list-group-item-figure">
                      <div class="tile tile-md bg-linkedin rounded-0">
                        <i class="fab fa-linkedin"></i>
                      </div>
                    </div><!-- /.list-group-item-figure -->
                    <!-- .list-group-item-body -->
                    <div class="list-group-item-body">
                      <input type="text" class="form-control" id="linkedin" placeholder="Linkedin Username">
                    </div><!-- /.list-group-item-body -->
                  </div><!-- /.list-group-item -->
                  <!-- .list-group-item -->
                  <div class="list-group-item">
                    <!-- .list-group-item-figure -->
                    <div class="list-group-item-figure">
                      <div class="tile tile-md bg-dribbble rounded-0">
                        <i class="fab fa-dribbble"></i>
                      </div>
                    </div><!-- /.list-group-item-figure -->
                    <!-- .list-group-item-body -->
                    <div class="list-group-item-body">
                      <input type="text" class="form-control" id="dribbble" placeholder="Dribbble Username">
                    </div><!-- /.list-group-item-body -->
                  </div><!-- /.list-group-item -->
                  <!-- .list-group-item -->
                  <div class="list-group-item">
                    <!-- .list-group-item-figure -->
                    <div class="list-group-item-figure">
                      <div class="tile tile-md bg-github rounded-0">
                        <i class="fab fa-github"></i>
                      </div>
                    </div><!-- /.list-group-item-figure -->
                    <!-- .list-group-item-body -->
                    <div class="list-group-item-body">
                      <input type="text" class="form-control" id="github" placeholder="Github Username">
                    </div><!-- /.list-group-item-body -->
                  </div><!-- /.list-group-item -->
                </div><!-- /.list-group -->
                <!-- .card-body -->
                <div class="card-body">
                  <hr>
                  <!-- .form-actions -->
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary ml-auto">Update Socials</button>
                  </div><!-- /.form-actions -->
                </div><!-- /.card-body -->
              </form><!-- /form -->
            </div><!-- /.card -->
          </div><!-- /grid column -->
        </div><!-- /grid row -->
      </div><!-- /.page-section -->
    </div>
  </div><!-- /.page-inner -->
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
    <script src="{{ asset('public/vendor/blueimp-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('public/vendor/blueimp-load-image/js/load-image.all.min.js') }}"></script>
    <script src="{{ asset('public/vendor/blueimp-canvas-to-blob/js/canvas-to-blob.min.js') }}"></script>
    <script src="{{ asset('public/vendor/blueimp-file-upload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('public/vendor/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('public/vendor/blueimp-file-upload/js/jquery.fileupload-process.js') }}"></script>
    <script src="{{ asset('public/vendor/blueimp-file-upload/js/jquery.fileupload-image.js') }}"></script>
    <script src="{{ asset('public/vendor/blueimp-file-upload/js/jquery.fileupload-validate.js') }}"></script>

    <!-- BEGIN PAGE LEVEL JS -->
    <script src="{{ asset('public/javascript/pages/user-settings-demo.js') }}"></script> <!-- END PAGE LEVEL JS -->
    <script>
      $(document).ready(function() {

        $('#profile_profile').show();

        $('.profile_setting_toggles').click(function(event) {

          let target = $(this).data('id');
          // event.preventDefault();
          
          $(this).siblings().removeClass('active text-primary bg-muted');
          $(this).addClass('active text-primary bg-muted');
          $('#'+target).siblings().hide();
          $('#'+target).show();
        });
      });
    </script>
@endsection