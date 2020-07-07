<!DOCTYPE html>
<html lang="{{ get_locale() }}">
<head>
    {{-- <base href="{{ trim(base_url(), '/').'/' }}"> --}}
    @php
      \App\Helpers\VisitorHelper::insert_visitor_all();
      Session::put('site_setting', \App\Models\Setting::first());
      if(!Session::has('site_setting') || (Session::has('site_setting') && Session::get('site_setting')->updated_at != (\App\Models\Setting::first())->updated_at)) {
        Session::put('site_setting', \App\Models\Setting::first());
      }
    @endphp
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title>@yield('fav_title') | {{ Config::get('app.locale') == 'en' ? ucwords(Session::get('site_setting')->title_en) : Session::get('site_setting')->title_bn }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <meta name="copyrighted-site-verification" content="55332bfaa5af1c44" />
    <meta name="msvalidate.01" content="17D6C246623B33D9C18FBDD89C498638" />
    

    <meta property="og:title" content="{{ Config::get('app.locale') == 'en' ? ucwords(Session::get('site_setting')->title_en) : Session::get('site_setting')->title_bn }} - @yield('fav_title') | {{ env('APP_SITE_NAME') }}" />
    <meta name="author" content="{{ Session::get('site_setting')->author }}" />
    <meta property="og:locale" content="bd" />
    <link rel="canonical" href="{{ url()->full() }}" />
    <meta property="og:url" content="{{ url()->full() }}" />
    <meta property="og:site_name" content="{{ env('APP_SITE_NAME') }}" />
    @section('meta')
    @show

    <script type="application/ld+json">
      {
        "name": "@yield('fav_title') | {{ Config::get('app.locale') == 'en' ? ucwords(Session::get('site_setting')->title_en) : Session::get('site_setting')->title_bn }}",
        "description": "@yield('description')",
        "author":
        {
          "@type": "Person",
          "name": "{{ Session::get('site_setting')->author }}"
        },
        "@type": "WebSite",
        "url": "{{ url()->full() }}",
        "headline": "{{ Session::get('site_setting')->title_en }}",
        "@context": "{{ base_url() }}"
      }
    </script><!-- End SEO tag -->
    <!-- FAVICONS -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset(Session::get('site_setting')->favicon) }}" />
    <link rel="shortcut icon" href="{{ asset(Session::get('site_setting')->favicon) }}" />
    <meta name="theme-color" content="{{ Route::is('book.wish_list') ? '#14141f':'#3063A0' }}" /><!-- End FAVICONS -->
    
    @include('frontend.partials.head')

    @include('frontend.partials.styles')

    @section('styles')
    @show
  </head>
  <body>
    <!-- .app -->
    <div id="app" class="app has-fullwidth">
      <!--[if lt IE 10]>
      <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
      <![endif]-->
      
      <init
        auth_id="{{ Auth::guard('admin')->check() ? encode_base64(Auth::guard('admin')->user()->id):encode_base64(0) }}"
        auth_mobile="{{ Auth::guard('admin')->check() ? encode_base64(Auth::guard('admin')->user()->mobile):'' }}"
        domain="{{ url('/') }}"
        locale="{{ Config::get('app.locale') }}"
        :file_default="{{ json_encode(Lang::get('backend/default')) }}"
        :file_form_field="{{ json_encode(Lang::get('backend/form_field')) }}"
        :file_table="{{ json_encode(Lang::get('backend/table')) }}"
      ></init>

      @include('frontend.partials.nav')
      {{-- @include('frontend.partials.sidebar') --}}

      <!-- .app-main -->
      <main class="app-main">
        <div v-cloak>
          <div class="v-cloak--inline pb-3">
            <i class="fad fa-atom fa-pulse fa-3x text-primary loader"></i>
          </div>
          <div class="v-cloak--hidden"> 
            <!-- .wrapper -->
            <div class="wrapper">
              <!-- .page -->
              <div class="page has-sidebar">
                <div class="alert-container" style="display: none;">
                  <div class="container">
                    @if(check_lang('en'))
                    <div class="alert alert-danger mt-3 px-2 alert-dismissible fade show border-0">
                      <button type="button" data-dismiss="alert" class="close " id="site_alert">×</button>
                      <h5>Hi!</h5>
                      <h6>Thank you for your early visit!</h6>
                      <div class="text-white rounded bg-dark px-1 py-3">Any action from you (except your signup details) may not be available in final release.</div>
                    </div>
                    @else
                    <div class="alert alert-danger mt-3 px-2 alert-dismissible fade show border-0">
                      <button type="button" data-dismiss="alert" class="close " id="site_alert">×</button>
                      <h5>ওহে!</h5>
                      <h6>সাইট প্রকাশ হবার আগে ভিজিট করার জন্য ধন্যবাদ!</h6>
                      <div class="text-white rounded bg-dark px-1 py-3">আপনার যেকোন এ্যাকশন (সাইনআপ তথ্য ব্যাতিত) ফাইনাল রিলিজে নাও থাকতে পারে।</div>
                    </div>
                    @endif
                  </div>
                </div>
                @section('content')
                @show
              </div><!-- /.page -->
            </div><!-- /.wrapper -->
            {{-- @include('frontend.partials.footer.footer') --}}
          </div>
        </div>

      </main><!-- /.app-main -->
    </div><!-- /.app -->
    @include('frontend.partials.footer.footer-top')
    @include('frontend.partials.footer.footer-2')
    @include('frontend.partials.scripts')
    @section('scripts')
    @show
    <script>
      if(parseInt(localStorage.site_alert) != 0) {
        $('.alert-container').show()
      }
      $(document).ready(function() {
        $('#site_alert').click(function(){
          localStorage.site_alert = 0
        });
      });
    </script>
  </body>
</html>