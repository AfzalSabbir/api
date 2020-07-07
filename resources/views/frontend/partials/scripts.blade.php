
    <!-- BEGIN BASE JS -->
    {{-- <script src="{{ asset('public/js/app_pre.js') }}"></script> --}}
    <script src="{{ asset('public/js/app.js') }}"></script> <!-- END THEME JS -->
    {{-- <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/vendor/popper.js/umd/popper.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.min.js') }}"></script> <!-- END BASE JS --> --}}
    <!-- BEGIN PLUGINS JS -->
    <script src="{{ asset('node_modules/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/vendor/pace-progress/pace.min.js') }}"></script>
    <script src="{{ asset('public/vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
    <script src="{{ asset('public/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('public/vendor/flatpickr/flatpickr.min.js') }}"></script>
    {{-- <script src="{{ asset('public/vendor/easy-pie-chart/jquery.easypiechart.min.js') }}"></script> --}}
    <script src="{{ asset('public/vendor/lazyload/lazyload.min.js') }}"></script>
    {{-- <script src="{{ asset('public/vendor/chart.js/Chart.min.js') }}"></script> <!-- END PLUGINS JS --> --}}
    <script src="{{ asset('public/vendor/moment/min/moment.min.js') }}"></script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="{{ asset('public/javascript/theme.min.js') }}"></script> <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    
    {{-- <script src="{{ asset('public/javascript/pages/dashboard-demo.js') }}"></script> --}} <!-- END PAGE LEVEL JS -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-170191538-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-170191538-1');
    </script>

    <script>
      lazyload();

      //logout
      function logout(){
        document.getElementById('admin-logout').submit();
      }
    </script>
    <script>
      window.addEventListener("hashchange", function () {
        window.scrollTo(window.scrollX, window.scrollY - 64);
      });
    </script>
    {{-- <script>
      $('.dropdown-menu.dropdown-menu-rich').on('click', function(event){
        var events = $._data(document, 'events') || {};
        events = events.click || [];
        for(var i = 0; i < events.length; i++) {
          if(events[i].selector) {

            if($(event.target).is(events[i].selector)) {
              events[i].handler.call(event.target, event);
            }

            $(event.target).parents(events[i].selector).each(function(){
              events[i].handler.call(this, event);
            });
          }
        }
        event.stopPropagation();
      });
    </script> --}}
    <script>
      $(document).ready(function() {
        $('.read_all').click(function(event){
          $(this).hide();
          $('#read_all').show();
          event.preventDefault()
        });
      });
    </script>