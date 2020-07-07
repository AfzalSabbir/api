@extends('backend.layouts.master')

@section('fav_title', __('backend/default.site_settings') )

@section('styles')
<style>
  .action{
    min-width: 70px;
  }
  .table th, .table td{
    vertical-align: middle;
  }
  .devTool::before {
    font-size: 30px !important;
    vertical-align: -1px !important;
  }
  #color-scheme {
    color: var(--nav-normal);
    background: var(--nav-primary);
  }
</style>
@endsection

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-sliders"></i> {{ __('backend/default.setting_management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg fa-fw"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('backend/default.setting') }}</li>
    <li class="breadcrumb-item active">{{ __('backend/default.edit') }}</li>
  </ul>
</div>
<div class="row mb-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="fa fa-pencil-square"></i>&nbsp;{{ __('backend/default.edit') }}</h2></div>
          <div class="col-md-6 text-right">
            {{-- @if(request()->filled('devTool') || $setting->show_dev_menu==1)
              <span class="animated-checkbox px-2 h2 mb-0">
                <label class="mb-0">
                  <input onclick="window.location='{{ route('admin.setting.show_dev_menu', encrypt($setting->show_dev_menu == 1 ? 0:1)) }}';" type="checkbox" {{ $setting->show_dev_menu == 1 ? 'checked':'' }}><span class="label-text devTool">Show Dev Menu</span>
                </label>
              </span>
            @endif --}}
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="card-body">

        <div class="form-row">
          <div class="col-md-3">
            <div class="position-relative p-1 pt-4 mt-4 setting_container col-sm-12">
              <span class="px-2 py-1 position-absolute setting_title l-1">Logo</span>
              <span class="px-2 py-1 position-absolute setting_title r-1">Favicon</span>
              <div class="form-row">
                <div class="col-6">
                  <img src="{{ asset($setting->logo) }}" alt="" style="height: 60px" class="img img-thumbnail">
                </div>
                <div class="col-6">
                  <img src="{{ asset($setting->favicon) }}" alt="" style="height: 60px; width: 60px;" class="img img-thumbnail float-right">
                </div>
              </div>
            </div>
            @if(env('APP_BACKEND_CUSTOMISATION'))
            <div class="position-relative p-1 pt-4 mt-4 setting_container col-sm-12 treeview">
              <span class="px-2 py-1 position-absolute setting_title l-1 cursor-pointer" title="All Schemes" id="color-scheme">Color Scheme&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="treeview-indicator fa fa-angle-left font-weight-bold d-inline-block"></i></span>
              {{-- all --}}
              <div id="all-scheme" style="display: none;">
                @foreach(\Config::get('theme_schemes') as $key => $theme)
                  @if($theme['meta']['status'] == 'active')
                    <div onclick="window.location='{{ route('admin.setting.color_scheme', encrypt($key)) }}';" class="col-sm-12 d-flex btn btn-group br-4 my-0 px-1 py-2 all-color-scheme {{ $setting->color_scheme_id == $key ? 'border-primary alert-success':'' }}" title="{{ $theme['meta']['name'] }}">
                      <span style="height: 50px; width: 33.3333%; background-color: {{ $theme['color_nav_primary'] }};" {{-- title="Nav" --}}></span>
                      <span style="height: 50px; width: 33.3333%; background-color: {{ $theme['color_nav_dark'] }};" {{-- title="Nav Left" --}}></span>
                      <span style="height: 50px; width: 33.3333%; background-color: {{ $theme['color_sidebar_primary'] }};" {{-- title="Sidebar" --}}></span>

                      <span style="background-color: {{ $theme['color_nav_normal'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_nav_light_25'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_nav_light_50'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_nav_light_75'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_nav_primary'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_nav_dark'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_nav_deep'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_sidebar_normal'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_sidebar_light_25'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_sidebar_light_50'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_sidebar_light_75'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_sidebar_primary'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_sidebar_dark'] }};" class="d-none"></span>
                      <span style="background-color: {{ $theme['color_sidebar_deep'] }};" class="d-none"></span>
                      <span style="height: 50px; width: 33.3333%; background-color: {{ $theme['color_sidebar_primary'] }};" class="d-none" {{-- title="Sidebar" --}}></span>
                    </div>
                  @endif
                @endforeach
              </div>
              {{-- active --}}
              <div id="active-scheme">
                @foreach(\Config::get('theme_schemes') as $key => $theme)
                  @if($theme['meta']['status'] == 'active' && $setting->color_scheme_id == $key)
                    <div class="col-sm-12 d-flex btn-group br-4 my-0 px-1 py-2" title="{{ $theme['meta']['name'] }}" id="active-color-scheme">
                      <span style="height: 50px; width: 33.3333%; background-color: {{ $theme['color_nav_primary'] }};" title="Nav"></span>
                      <span style="height: 50px; width: 33.3333%; background-color: {{ $theme['color_nav_dark'] }};" title="Nav Left"></span>
                      <span style="height: 50px; width: 33.3333%; background-color: {{ $theme['color_sidebar_primary'] }};" title="Sidebar"></span>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
            <theme-customisation
            custom_scroll = "{{ $setting->custom_scroll }}"
            custom_scroll_route = "{{ route('admin.setting.custom_scroll', encrypt($setting->custom_scroll == 1 ? 0:1)) }}"

            show_user_data = "{{ $setting->show_user_data }}"
            show_user_data_route = "{{ route('admin.setting.show_user_data', encrypt($setting->show_user_data == 1 ? 0:1)) }}"

            show_background_image = "{{ $setting->show_background_image }}"
            show_background_image_route = "{{ route('admin.setting.show_background_image', encrypt($setting->show_background_image == 1 ? 0:1)) }}"
            
            apply_scheme_on_card = "{{ $setting->apply_scheme_on_card }}"
            apply_scheme_on_card_route = "{{ route('admin.setting.apply_scheme_on_card', encrypt($setting->apply_scheme_on_card == 1 ? 0:1)) }}"
            ></theme-customisation>
            @endif
          </div>
          <div class="col-md-9">
            @include('backend.partials.error_message')
            <form action="{{ route('admin.setting.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="position-relative p-2 mt-4 setting_container">
                <span class="px-2 py-1 position-absolute setting_title">Contact</span>
                <div class="form-row">
                  <div class="col-md-6 mt-3" id="address_div">
                    <label for="address" id="address_label">Address <span class="text-danger">*</span></label>
                    <textarea type="text" name="address" id="address" class="form-control" required>{!! $setting->address !!}</textarea> 
                  </div>
                  <div class="col-md-6" id="find_hide">
                    <div class="col-sm-12 mt-3 px-0">
                      <label for="title">Site Title <span class="text-danger">*</span></label>
                      <div class="form-row">
                        <div class="col-sm-6">
                          <input type="text" name="title_bn" id="title_bn" value="{{ $setting->title_bn }}" class="form-control avro_bn" required placeholder="বাংলা">
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="title_en" id="title_en" value="{{ $setting->title_en }}" class="form-control" required placeholder="English">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12 mt-3 px-0">
                      <label for="email">Email <span class="text-danger">*</span></label>
                      <input type="email" name="email" id="email" value="{{ $setting->email }}" class="form-control" required>
                    </div>
                    <div class="col-sm-12 mt-3 px-0">
                      <label for="mobile">Mobile <span class="text-danger">*</span></label>
                      <input type="text" name="mobile" id="mobile" value="{{ $setting->mobile }}" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="position-relative p-2 mt-4 setting_container">
                <span class="px-2 py-1 position-absolute setting_title">Social</span>
                <div class="form-row">
                  <div class="col-md-6 mt-3">
                    <label for="facebook">Facebook <span class="text-danger">*</span></label>
                    <input type="text" name="facebook" id="facebook" value="{{ $setting->facebook }}" class="form-control" required>
                  </div>

                  <div class="col-md-6 mt-3">
                    <label for="twitter">Twitter <span class="text-danger">*</span></label>
                    <input type="twitter" name="twitter" id="twitter" value="{{ $setting->twitter }}" class="form-control" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-6 mt-3">
                    <label for="youtube">Youtube <span class="text-danger">*</span></label>
                    <input type="text" name="youtube" id="youtube" value="{{ $setting->youtube }}" class="form-control" required>
                  </div>

                  <div class="col-md-6 mt-3">
                    <label for="linkedin">Linkedin <span class="text-danger">*</span></label>
                    <input type="linkedin" name="linkedin" id="linkedin" value="{{ $setting->linkedin }}" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="position-relative p-2 mt-4 setting_container">
                <span class="px-2 py-1 position-absolute setting_title">Logo & Favicon</span>
                <div class="form-row">
                  <div class="col-md-6 mt-3">
                    <label for="logo">Logo </label>
                    <input type="file" name="logo" id="logo" class="form-control">
                  </div>
                  <div class="col-md-6 mt-3">
                    <label for="favicon">Favicon </label>
                    <input type="file" name="favicon" id="favicon" class="form-control">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-12 mt-3">
                    <label for="description">Description </label>
                    <textarea type="text" name="description" id="description" class="form-control" rows="8">{!! $setting->description !!}</textarea>
                  </div>
                </div>
              </div>

              <button class="btn btn-success float-right mt-2" type="submit">{{ __('backend/default.submit') }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  $('#address').css({
    'min-height': $('#find_hide').height() - $('label').outerHeight() - 8
  });
  $(function(){
    $('.avro_bn').avro({
      'bangla':true
    });
  });
  
  $(document).ready(function() {

    $('#color-scheme').click(function(){
      $(this).closest('div').toggleClass('is-expanded');
      $('#active-scheme').fadeToggle('fast');
      $('#all-scheme').slideToggle();
    });

    var colors = ['--nav-primary', '--nav-dark', '--sidebar-primary', '--nav-normal', '--nav-light-25', '--nav-light-50', '--nav-light-75', '--nav-primary', '--nav-dark', '--nav-deep', '--sidebar-normal', '--sidebar-light-25', '--sidebar-light-50', '--sidebar-light-75', '--sidebar-primary', '--sidebar-dark', '--sidebar-deep'];
    
    $('.all-color-scheme').click(function(){
      var i = 0;
      $(this).children('span').each(function(){
        document.documentElement.style.setProperty(colors[i++], $(this).css('background-color'));
      });
    });
    $('.all-color-scheme').mouseenter(function(){
      var i = 0;
      $(this).children('span').each(function(){
        document.documentElement.style.setProperty(colors[i++], $(this).css('background-color'));
      });
    }).mouseleave(function() {
      var i = 0;
      $(this).children('span').each(function(){
        document.documentElement.style.setProperty(colors[i++], '');
      });      
    });
  });
</script>
@endsection
