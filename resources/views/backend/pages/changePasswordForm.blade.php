@extends('backend.layouts.master')

@section('fav_title', __('backend/default.change_password') )

@section('styles')
<style type="text/css">
  #eye{
    right: 0;
    bottom: 0;
    font-size: 20px;
    height: 36px;
    color: var(--nav-primary);
  }
  #eye:hover,
  #eye:focus{
    -webkit-box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.4) !important;
    box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.4) !important;
  }
</style>
@endsection

@section('content')

  <!-- Permission -->
  @php
    $permissions = \App\Models\Menu::orderBy('id', 'desc')->where('url', substr(url()->current(), 1+strlen(url('/'))))->orWhere('url', substr(url()->current(), strlen(url('/'))))->first();

    // 3 is user role
    if (Auth::guard('admin')->user()->admin_role == 3) {
      $myRole = \App\Models\Role::where('admin_id', Auth::guard('admin')->user()->id)->first();
    } else {
      $myRole = \App\Models\Role::where('role', Auth::guard('admin')->user()->admin_role)->first();
    }

    //get SubMenus
    $thisRoute          = \Request::route()->getName();
    $sub_menu_by_route  = \App\Helpers\ModuleHelper::get_menu_by_route($thisRoute);
    $thisSubMenus       = current($sub_menu_by_route)['childs'];
    $mySubMenus         = json_decode($myRole->sub_menu);

    $role_unique = \App\Models\Menu::select(['id', 'menu', 'menu_bn', 'icon_color as color'])->where('url', 'like', '%'.Session::get('site_setting')->admin_prefix.'/role/assign'.'%')->get()->keyBy('menu')->toArray();
  @endphp

<div class="app-title">
  <div>
    <h1><i class="fa fa-key"></i> {{ __('backend/admin_setting.change_password') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg fa-fw"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('backend/admin_setting.admin_setting') }}</li>
    <li class="breadcrumb-item active">{{ __('backend/admin_setting.change_password') }}</li>
  </ul>
</div>

<div class="row mb-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="fa fa-table"></i>&nbsp;{{ __('backend/admin_setting.change_password') }}</h2></div>
          <div class="col-md-6 btn-group justify-content-end">

            {{-- SubMenu --}}
            @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus])

          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="card-body">
        <div class="main-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card mb-3 col-md-6 offset-md-3">
              <div class="card-body">
                @include('backend.partials.message')
                <form action="{!! route('admin.password.change') !!}" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="old_password">{{ __('backend/default.old') .' '. __('backend/default.password') }} <span class="text-danger required">*</span></label>
                    <input autocomplete="none" type="password" class="form-control" name="old_password" id="old_password" placeholder="{{ __('backend/default.old') .' '. __('backend/default.password') }}" required>
                    @if ($errors->has('old_password'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('old_password') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="password">{{ __('backend/default.new') .' '. __('backend/default.password') }} <span class="text-danger required">*</span></label>
                    <input autocomplete="none" type="password" class="form-control" name="password" id="password" placeholder="{{ __('backend/default.new') .' '. __('backend/default.password') }}" required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group position-relative">
                    <label for="password_confirmation">{{ __('backend/default.confirm') .' '. __('backend/default.password') }} <span class="text-danger required">*</span></label>
                    <input autocomplete="none" type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ __('backend/default.confirm') .' '. __('backend/default.new') .' '. __('backend/default.password') }}" required>
                    <span id="eye" class="fa fa-eye btn btn-xs py-0 position-absolute"></span>
                    @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                  </div>

                  <button type="submit" class="btn btn-success float-right mt-2">{{ __('backend/default.change') }}</button>
                </form>
              </div><!-- end card-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('#eye').click(function(){
      if ($(this).hasClass('fa-eye')) {
        $('#password_confirmation').attr('type', 'text'); 
        $('.fa-eye').addClass('fa-eye-slash');
        $('.fa-eye-slash').removeClass('fa-eye');
      }else if ($(this).hasClass('fa-eye-slash')) {
        $('#password_confirmation').attr('type', 'password'); 
        $('.fa-eye-slash').addClass('fa-eye');
        $('.fa-eye').removeClass('fa-eye-slash');
      }
    }); 
  });
</script>
@endsection
