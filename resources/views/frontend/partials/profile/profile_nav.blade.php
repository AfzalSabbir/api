            <!-- .page-navs -->
            <nav class="page-navs">
              <!-- .nav-scroller -->
              <div class="nav-scroller">
                <!-- .nav -->
                <div class="nav nav-center nav-tabs">
                  <a class="nav-link {{ Route::is('profile') ? 'active':'' }}" href="{{ route('profile') }}">{{ __('backend/default.overview') }}</a>
                  <a class="nav-link {{ Route::is(['profile.my_books', 'profile.add_book', 'profile.edit_book', 'profile.book.bell_list']) ? 'active':'' }}" href="{{ route('profile.my_books') }}">{{ __('backend/default.book') }}</a>
                  <a class="nav-link {{ Route::is(['profile.setting', 'account.setting']) ? 'active':'' }}" href="{{ route('profile.setting') }}">{{ __('backend/default.settings') }}</a>
                </div><!-- /.nav -->
              </div><!-- /.nav-scroller -->
            </nav><!-- /.page-navs -->