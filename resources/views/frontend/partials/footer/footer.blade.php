
        <!-- .app-footer -->
        <footer class="app-footer py-3 mb-0 border-top">
          <ul class="list-inline">
            <li class="list-inline-item">
              @if (session()->get('locale')=='bn')
                <a class="text-muted" href="{{ route('language', 'en') }}" title="Change Language">{{ __('backend/default.locale') }}</a>
              @else
                <a class="text-muted" href="{{ route('language', 'bn') }}" title="ভাষা পরিবর্তন করুন">{{ __('backend/default.locale') }}</a>
              @endif
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="#">Support</a>
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="#">Help Center</a>
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="#">Privacy</a>
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="#">Terms of Service</a>
            </li>
          </ul>
          <div class="copyright"> Copyright &copy; {{ date('Y') }}. All right reserved. </div>
        </footer><!-- /.app-footer -->