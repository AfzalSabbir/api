      @php($site_setting = session()->get('site_setting'))
      <section class="pt-3 bg-black text-white">
        <!-- .container -->
        <div class="container">
          <!-- .row -->
          <div class="row">
            <p class="text-muted text-center w-100"> &copy; {{ n2l(date('Y')) }} <a href="{{ route('home') }}" title="{{ __('backend/default.boinaw') }}">{{ __('backend/default.boinaw') }}</a> - {{ __('backend/default.all_rights_reserved') }} {{ __('backend/default..') }} </p>
          </div><!-- /.row -->
        </div><!-- /.container -->
      </section>