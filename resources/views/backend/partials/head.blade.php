<style type="text/css">

  @php
    $scheme = \Config::get('theme_schemes.'.$site_setting->color_scheme_id);
    $scheme_card = $site_setting->apply_scheme_on_card;
  @endphp

  :root {
    --nav-normal        : {{ $scheme['color_nav_normal'] }};
    --nav-light-5       : {{ $scheme['color_nav_light_5'] }};
    --nav-light-10      : {{ $scheme['color_nav_light_10'] }};
    --nav-light-25      : {{ $scheme['color_nav_light_25'] }};
    --nav-light-50      : {{ $scheme['color_nav_light_50'] }};
    --nav-light-75      : {{ $scheme['color_nav_light_75'] }};
    --nav-primary       : {{ $scheme['color_nav_primary'] }};
    --nav-dark          : {{ $scheme['color_nav_dark'] }};
    --nav-deep          : {{ $scheme['color_nav_deep'] }};
    
    --sidebar-normal    : {{ $scheme['color_sidebar_normal'] }};
    --sidebar-light-5   : {{ $scheme['color_sidebar_light_5'] }};
    --sidebar-light-10  : {{ $scheme['color_sidebar_light_10'] }};
    --sidebar-light-25  : {{ $scheme['color_sidebar_light_25'] }};
    --sidebar-light-50  : {{ $scheme['color_sidebar_light_50'] }};
    --sidebar-light-75  : {{ $scheme['color_sidebar_light_75'] }};
    --sidebar-primary   : {{ $scheme['color_sidebar_primary'] }};
    --sidebar-dark      : {{ $scheme['color_sidebar_dark'] }};
    --sidebar-deep      : {{ $scheme['color_sidebar_deep'] }};

    --select-primary    : {{ $scheme_card == 1 ? 'var(--nav-primary)' : '#adadad' }};
    --select-light-10   : {{ $scheme_card == 1 ? 'var(--nav-light-10)' : '#e1e1e1' }};

    --card-normal       : {{ $scheme_card == 1 ? 'var(--nav-normal)' : '#e5e5e5' }};
    --card-light-5      : {{ $scheme_card == 1 ? 'var(--nav-light-5)' : 'rgba(0, 0, 0, 0.05)' }};
    --card-light-10     : {{ $scheme_card == 1 ? 'var(--nav-light-10)' : 'rgba(0, 0, 0, 0.075)' }};
    --card-light-25     : {{ $scheme_card == 1 ? 'var(--nav-light-25)' : '#dee2e6' }};
    --card-light-50     : {{ $scheme_card == 1 ? 'var(--nav-light-50)' : 'rgba(0, 0, 0, 0.125)' }};
    --card-light-75     : {{ $scheme_card == 1 ? 'var(--nav-light-75)' : 'rgba(0, 0, 0, 0.125)' }};
    --card-primary      : {{ $scheme_card == 1 ? 'var(--nav-light-10)' : '#d1ecf1' }};
    --card-dark         : {{ $scheme_card == 1 ? 'var(--nav-light-25)' : '#bee5eb' }};
    --card-deep         : {{ $scheme_card == 1 ? 'var(--nav-deep)' : '#0c5460' }};

    --form-light-10     : {{ $scheme_card == 1 ? 'var(--nav-light-10)' : '#e9ecef' }};
    --form-light-25     : {{ $scheme_card == 1 ? 'var(--nav-light-25)' : '#ced4da' }};
    --form-light-50     : {{ $scheme_card == 1 ? 'var(--nav-light-50)' : '#ced4da' }};
  }

  @if($site_setting->show_background_image == 1)
  main#app {
    background: url({{ asset('public/images/admin-bg.jpg') }});
    background-repeat: repeat;
  }
  @endif
</style>
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
    display: block;
  }
  [v-cloak] .v-cloak--inline {
    display: inline;
  }
  [v-cloak] .v-cloak--inlineBlock {
    display: inline-block;
  }
  [v-cloak] .v-cloak--hidden {
    display: none;
  }
  [v-cloak] .v-cloak--invisible {
    visibility: hidden;
  }
  .v-cloak--block,
  .v-cloak--inline,
  .v-cloak--inlineBlock {
    display: none;
  }
  i.fa.fa-spinner.fa-pulse.fa-3x.fa-fw {
    margin-left: 46%;
    bottom: 50%;
    margin-top: 11%;
  }
  .loader{
    margin-left: 46%;
    bottom: 50%;
    margin-top: 11%;
  }
</style>



<script src="{{ asset('public/backend/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('public/backend/js/jquery-ui.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/backend/js/toastr.min.js') }}"></script>
<script type="text/javascript">
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "3000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
</script>
{{-- <script type="text/javascript">
  window.onload = function(){
    var url = window.location.href;
    var str = "#me_";
    if (window.location.href.indexOf(str) == -1){
      location.replace(url+str);
    }
  }
</script> --}}