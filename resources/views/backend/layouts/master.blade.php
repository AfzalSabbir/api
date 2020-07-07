<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="robots" content="noindex,nofollow">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  @php
    \App\Helpers\VisitorHelper::insert_visitor_all();
    $site_setting = \App\Models\Setting::first();
    Session::put('site_setting', \App\Models\Setting::first());
    $role_name    = \App\Helpers\ConfigHelper::getRole(Auth::guard('admin')->user()->admin_role);
  @endphp

  <link rel="icon" href="{!!  asset($site_setting->favicon)  !!}" type="image/gif" sizes="16x16">
  <meta name="theme-color" content="#3063A0">

  <title>{{ Config::get('app.locale') == 'en' ? ucwords($site_setting->title_en) : $site_setting->title_bn }} - @yield('fav_title')</title>

  @include('backend.partials.head')
  
  @include('backend.partials.styles')

  @section('styles')
  @show

  @include('backend.partials.permission')

</head>

<body class="app sidebar-mini rtl">

  @include('backend.partials.nav')

  @include('backend.partials.sidebar')

  <div id="main-wrapper">

    @include('backend.partials.message')
    <main class="app-content" id="app">

      <div v-cloak>
        <div class="v-cloak--inline">
          <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        </div>

        <div class="v-cloak--hidden"> 
          <init 
          :auth_id="{{ Auth::guard('admin')->user()->id }}"
          domain="{{ url('/') }}"
          locale="{{ Config::get('app.locale') }}"
          :file_default="{{ json_encode(Lang::get('backend/default')) }}"
          :file_form_field="{{ json_encode(Lang::get('backend/form_field')) }}"
          :file_table="{{ json_encode(Lang::get('backend/table')) }}"
          ></init>

          @section('content')
          @show
        </div>
      </div>
      {{-- @include('backend.partials.footer') --}}
    </main>

  </div>

  @include('backend.partials.scripts')

  @section('scripts')
  @show

  
</body>
</html>