@if (Session::has('add_message'))
  <script>
    toastr.success("{{ __('backend/flash.add_message') }}");
  </script>
@endif

@if (Session::has('update_message'))
  <script>
    toastr.success("{{ __('backend/flash.update_message') }}");
  </script>
@endif

@if (Session::has('warning'))
  <script>
    toastr.warning("{{ Session::get('warning') }}");
  </script>
@endif

@if (Session::has('success'))
  <script>
    toastr.success("{{ Session::get('success') }}");
  </script>
@endif

@if (Session::has('delete_message'))
  <script>
    toastr.warning("{{ __('backend/flash.delete_message') }}");
  </script>
@endif

@if (Session::has('exist_message'))
  <script>
    toastr.error("{{ __('backend/flash.exist_message') }}");
  </script>
@endif

@if (Session::has('inactive_message'))
  <script>
    toastr.error("{{ __('backend/flash.inactive_message') }}");
  </script>
@endif

@if (Session::has('theme_success_message'))
  <script>
    toastr.success("{{ __('backend/flash.theme_success_message') }}");
  </script>
@endif
@if (Session::has('theme_error_message'))
  <script>
    toastr.error("{{ __('backend/flash.theme_error_message') }}");
  </script>
@endif
@if (Session::has('theme_already_active'))
  <script>
    toastr.warning("{{ __('backend/flash.theme_already_active') }}");
  </script>
@endif