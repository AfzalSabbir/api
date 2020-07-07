<!DOCTYPE html>
<html lang="en">
<head>
    @php
      \App\Helpers\VisitorHelper::insert_visitor_all();
      Session::put('site_setting', \App\Models\Setting::first());
    @endphp

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title>{{ Config::get('app.locale') == 'en' ? ucwords(Session::get('site_setting')->title_en) : Session::get('site_setting')->title_bn }} - @yield('fav_title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="copyrighted-site-verification" content="55332bfaa5af1c44" />
    <meta name="msvalidate.01" content="17D6C246623B33D9C18FBDD89C498638" />
    

    <meta property="og:title" content="{{ Config::get('app.locale') == 'en' ? ucwords(Session::get('site_setting')->title_en) : Session::get('site_setting')->title_bn }} - @yield('fav_title')">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="index-2.html">
    <meta property="og:url" content="index-2.html">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">
    <script type="application/ld+json">
      {
        "name": "Looper - Bootstrap 4 Admin Theme",
        "description": "Responsive admin theme build on top of Bootstrap 4",
        "author":
        {
          "@type": "Person",
          "name": "Beni Arisandi"
        },
        "@type": "WebSite",
        "url": "",
        "headline": "Sign In",
        "@context": "http://schema.org"
      }
    </script><!-- End SEO tag -->
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset(Session::get('site_setting')->favicon) }}">
    <link rel="shortcut icon" href="{{ asset(Session::get('site_setting')->favicon) }}">
    <meta name="theme-color" content="#3063A0"><!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="{{ asset('public/vendor/%40fontawesome/fontawesome-pro/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendor/%40fontawesome/fontawesome-pro/css/custom.min.css') }}"><!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="{{ asset('public/stylesheets/theme.min.css') }}" data-skin="default">
    <link rel="stylesheet" href="{{ asset('public/stylesheets/theme-dark.min.css') }}" data-skin="dark">
    <link rel="stylesheet" href="{{ asset('public/stylesheets/custom.css') }}">
    <script>
      var skin = localStorage.getItem('skin') || 'default';
      var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
      var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
      // Disable unused skin immediately
      disabledSkinStylesheet.setAttribute('rel', '');
      disabledSkinStylesheet.setAttribute('disabled', true);
      // add flag class to html immediately
      if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script><!-- END THEME STYLES -->
    
    <style>
      .preloader {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-image: "{{ asset('public/5.gif')  }}";
        background-repeat: no-repeat; 
        background-color: #FFF;
        background-position: center;
      }
      .toast-top-right {
        top: 65px !important;
        right: 15px !important;
      }
      [v-cloak] .v-cloak--block {
        display: block !important;
      }
      [v-cloak] .v-cloak--inline {
        display: inline !important;
      }
      [v-cloak] .v-cloak--inlineBlock {
        display: inline-block !important;
      }
      [v-cloak] .v-cloak--hidden {
        display: none !important;
      }
      [v-cloak] .v-cloak--invisible {
        visibility: hidden !important;
      }
      .v-cloak--block,
      .v-cloak--inline,
      .v-cloak--inlineBlock {
        display: none !important;
      }
      @media(min-width: 768px) {
        i.loader {
          margin-left: 49%;
          bottom: 50%;
          margin-top: 11%;
        }
        .fa-md-2x {
          font-size: 4rem !important;
        }
      }

      @media(max-width: 767.98px) {
        i.loader {
          margin-left: 46%;
          bottom: 50%;
          margin-top: 11%;
        }
      }

      @media(max-width: 575.98px) {
        i.loader {
          margin-left: 46%;
          bottom: 50%;
          margin-top: 11%;
        }
      }
      /* .loader{
        margin-left: 46%;
        bottom: 50%;
        margin-top: 11%;
      } */
    </style>

    @section('styles')
    @show
    
  </head>
  <body>
    <!-- .app -->
    <div id="app">
      <!--[if lt IE 10]>
      <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
      <![endif]-->

      <init
      :auth_id="{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id:0 }}"
      domain="{{ url('/') }}"
      locale="{{ Config::get('app.locale') }}"
      :file_default="{{ json_encode(Lang::get('backend/default')) }}"
      :file_form_field="{{ json_encode(Lang::get('backend/form_field')) }}"
      :file_table="{{ json_encode(Lang::get('backend/table')) }}"
      ></init>

      <main class="app-main pt-0">
        @if(!Route::is(['user.showRecoverForm']))
        <div v-cloak>
          <div class="v-cloak--inline pb-3">
            <i class="fad fa-atom fa-pulse fa-3x text-primary loader"></i>
          </div>
          <div class="v-cloak--hidden">
            @section('content')
            @show
          </div>
        </div>
        @else
          @section('content')
          @show
        @endif
      </main>
    </div>

    <!-- BEGIN BASE JS -->
    @if(!Route::is(['user.showRecoverForm']))
    <script src="{{ asset('public/js/app.js') }}"></script>
    @endif
    
    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.min.js') }}"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="{{ asset('public/vendor/particles.js/particles.js') }}"></script>
    {{-- <script>
      /**
       * Keep in mind that your scripts may not always be executed after the theme is completely ready,
       * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
       */
      $(document).on('theme:init', () =>
      {
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('auth-header', '{{ asset("public/javascript/pages/particles.json") }}');
      })
    </script> --}} <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="{{ asset('public/javascript/theme.js') }}"></script> <!-- END THEME JS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170191538-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-170191538-1');
    </script>

    @section('scripts')
    @show
  </body>
</html>