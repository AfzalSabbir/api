
    <!-- GOOGLE FONT -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"> --}}<!-- End GOOGLE FONT -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="{{asset('public/vendor/open-iconic/font/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendor/%40fontawesome/fontawesome-pro/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/vendor/%40fontawesome/fontawesome-pro/css/custom.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('public/vendor/%40fontawesome/fontawesome-free/css/all.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('public/vendor/flatpickr/flatpickr.min.css')}}"><!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="{{asset('public/stylesheets/theme.min.css')}}" data-skin="default">
    {{-- <link rel="stylesheet" href="{{asset('public/stylesheets/theme-dark.min.css')}}" data-skin="dark"> --}}
    <link rel="stylesheet" href="{{asset('public/stylesheets/custom.css')}}">
    {{-- <script>
      var skin = localStorage.getItem('skin') || 'default';
      var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
      var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
      // Disable unused skin immediately
      disabledSkinStylesheet.setAttribute('rel', '');
      disabledSkinStylesheet.setAttribute('disabled', true);
      // add flag class to html immediately
      if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script> --}}<!-- END THEME STYLES -->
    <link rel="stylesheet" href="{{ asset('node_modules/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/owl.carousel/dist/assets/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/toastr/build/toastr.min.css') }}" />
    
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
      /* i.fa.fa-spinner.fa-pulse.fa-3x.fa-fw {
        margin-left: 46%;
        bottom: 50%;
        margin-top: 11%;
      }
      i.fad.fa-spinner.fa-pulse.fa-3x.fa-fw {
        margin-left: 46%;
        bottom: 50%;
        margin-top: 11%;
      }
      i.fad.fa-spinner-third.fa-pulse.fa-3x.fa-fw {
        margin-left: 46%;
        bottom: 50%;
        margin-top: 11%;
      } */
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
    {{-- <script type="text/javascript" src="{{ asset('public/backend/js/toastr.min.js') }}"></script>
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
    </script> --}}