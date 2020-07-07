      <!-- .app-header -->
      @php
        //Message
        $signedIn = false;
        $has_message = 0;
        $has_notification = 0;
        if (Auth::guard('admin')->check()) {
          $signedIn = true;

          $admin_id = Auth::guard('admin')->user()->id;
          /*
            status = 1: Unread | 2: read
           */
          $has_message = \App\Models\Message::where(['admin_id'=>$admin_id, 'status'=>1, 'message_type'=>2])->get()->count();
          $has_notification = \App\Models\Message::where(['admin_id'=>$admin_id, 'status'=>1, 'message_type'=>3])->get()->count();

        }
      @endphp
      <!-- .app-header -->
      <header class="app-header app-header-dark">
        <!-- .navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-lg-0">
          <!-- .container -->
          <div class="container">
            <!-- .navbar-brand -->
            {{-- <a class="navbar-brand" href="{{ route('home') }}" @click.prevent> --}}
              <img height=30 width=115 src="{{ Route::is(['book.wish_list', 'profile.my_wish_list']) ? asset('public/images/icon/jpg/boinaw-black-white.jpg'):asset(Session::get('site_setting')->logo) }}" alt="" style="">
              {{-- <span style="font-family: 'Niconne'; font-size: 2.8rem; font-weight: 600; line-height: 55px;">B<sup>oi</sup>N<small>aw</small></span> --}}
            {{-- </a> --}} <!-- /.navbar-brand -->
            <button class="hamburger hamburger-squeeze d-flex d-lg-none" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button> <!-- .navbar-collapse -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <!-- .navbar-nav -->
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <!-- Home -->
                <li class="nav-item">
                  <a class="nav-link {{ Route::is('home') ? 'active font-weight-bold' : '' }}" href="{{ route('home') }}"> {{ __('backend/default.home') }} <span class="sr-only">(current)</span></a>
                </li><!-- /Home -->
                <!-- Book -->
                <li class="nav-item">
                  <a class="nav-link {{ Route::is(['book.browse', 'book.browse.free', 'book.view.slug']) ? 'active font-weight-bold' : '' }}" href="{{ route('book.browse') }}"> {{ __('backend/default.book') }} <span class="sr-only">(current)</span></a>
                </li><!-- /Book -->
                <!-- Grade -->
                <li class="nav-item dropdown">
                  <a class="nav-link {{ Route::is('book.grade.browse') ? 'active font-weight-bold' : '' }}" href="#" id="navbarGradeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="mr-1">{{ __('backend/default.grade') }}</span> <i class="fas fa-angle-down ml-auto"></i></a>
                  <ul class="dropdown-menu" aria-labelledby="navbarGradeDropdown">
                    @php
                      $full_url = url()->full();
                      $exp_url = explode('/', $full_url);
                      $exp_grade = $exp_url[count($exp_url)-2];
                    @endphp
                    @foreach (\App\Models\Grade::where('status', 1)->get() as $grade)
                      <!-- Grade Page -->
                      <li>
                        <a class="dropdown-item {{ $exp_grade == $grade->slug ? 'active':'' }}" href="{{ route('book.grade.browse', $grade->slug) }}">{{ check_lang('bn') ? $grade->title_bn:$grade->title }}</a>
                      </li><!-- /Grade Page -->
                    @endforeach
                  </ul>
                </li>
                <!-- /Grade -->
                <!-- Location -->
                <li class="nav-item dropdown">
                  <a class="nav-link {{ Route::is(['book.location', 'book.district.district_name.browse', 'book.upazila.upazila_name.browse']) ? 'active font-weight-bold' : '' }}" href="#" id="navbarLocationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="mr-1">{{ __('backend/default.location') }}</span> <i class="fas fa-angle-down ml-auto"></i></a>
                  <ul class="dropdown-menu" aria-labelledby="navbarLocationDropdown">
                    @php
                      $full_url = url()->full();
                      $exp_url = explode('/', $full_url);
                      $exp_location = $exp_url[count($exp_url)-2];
                    @endphp
                    <!-- District Page -->
                    <li>
                      <a class="dropdown-item {{ ($exp_location == 'district' || Route::is(['book.district.district_name.browse'])) ? 'active font-weight-bold':'' }}" href="{{ route('book.location', 'district') }}">{{ __('backend/default.district') }}</a>
                    </li><!-- /District Page -->
                    <!-- Upazila Page -->
                    <li>
                      <a class="dropdown-item {{ ($exp_location == 'upazila' || Route::is(['book.upazila.upazila_name.browse'])) ? 'active font-weight-bold':'' }}" href="{{ route('book.location', 'upazila') }}">{{ __('backend/default.upazila') }}</a>
                    </li><!-- /Upazila Page -->
                  </ul>
                </li>
                <!-- /Location -->

                <!-- Library -->
                <li class="nav-item">
                  <a class="nav-link {{ Route::is('library') ? 'active font-weight-bold' : '' }}" href="{{ route('library') }}"> {{ __('backend/default.library') }} <span class="sr-only">(current)</span></a>
                </li><!-- /Library -->

                <!-- Wish List -->
                <li class="nav-item">
                  <a class="nav-link {{ Route::is('book.wish_list') ? 'active font-weight-bold' : '' }}" href="{{ route('book.wish_list') }}"> {{ __('backend/default.wish_list') }} <span class="sr-only">(current)</span></a>
                </li><!-- /Wish List -->
              </ul><!-- /.navbar-nav -->

              <!-- .top-bar-search -->
              <nav-search></nav-search><!-- /.top-bar-search -->


              <ul class="header-nav nav d-none d-lg-flex">
                @if (Auth::guard('admin')->check())
                  <nav-notifications
                    url="{{ route('notification.axios.short_notification') }}"
                    url_this_read="{{ route('notification.axios.read_this_notification') }}"
                    url_all_notification="{{ route('notification.history') }}"
                    {{-- inbox={{ Route::is('message.inbox') ? 1:0 }} --}}
                  ></nav-notifications>
                  <nav-message
                    url="{{ route('message.axios.short_inbox') }}"
                    url_this_read="{{ route('message.axios.read_this_message') }}"
                    url_all_message="{{ route('message.inbox') }}"
                    inbox={{ Route::is('message.inbox') ? 1:0 }}
                  ></nav-message>
                @endif

                @php($urls = ['add_book' => route('profile.add_book'), 'setting' => route('profile.setting'), 'wish_list' => route('profile.my_wish_list') ])
                <nav-app-shorts
                urls="{{ json_encode($urls) }}"
                ></nav-app-shorts>

              </ul>
              {{-- Mobile AppShorts --}}
              <ul class="header-nav nav d-flex d-lg-none p-0">
                <li class="nav-item dropdown header-nav-dropdown has-notified d-none">
                  <a href="#" class="nav-link m-0"><span class="oi oi-pulse"></span></a>
                </li>

                <li class="nav-item dropdown header-nav-dropdown {{ ($has_notification>0 && !Route::is('notification.history')) ? 'has-notified':''}}">
                  <a href="{{ route('notification.history') }}" class="tile-wrapper">
                    <span class="tile tile-lg bg-transparent text-white mb-0" style="height: 2.3rem"><i class="fad fa-bells"></i></span>
                    <span class="text-white tile-peek">{{ __('backend/default.notification_') }}</span>
                  </a>
                </li>

                <li class="nav-item dropdown header-nav-dropdown {{ ($has_message>0 && !Route::is('message.inbox')) ? 'has-notified':''}}">
                  <a href="{{ route('message.inbox') }}" class="tile-wrapper">
                    <span class="tile tile-lg bg-transparent text-white mb-0" style="height: 2.3rem"><i class="fad fa-envelope{{ Route::is('message.inbox') ? '-open':'' }}"></i></span>
                    <span class="text-white tile-peek">{{ __('backend/default.message') }}</span>
                  </a>
                </li>

                <li>
                  <a href="{{ route('profile.add_book') }}" class="tile-wrapper">
                    <span class="tile tile-lg bg-transparent text-white mb-0" style="height: 2.3rem"><i class="fad fa-books-medical"></i></span>
                    <span class="text-white tile-peek">{{ __('backend/default.book') }}</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('profile.setting') }}" class="tile-wrapper">
                    <span class="tile tile-lg bg-transparent text-white mb-0" style="height: 2.3rem"><i class="fad fa-user-cog"></i></span>
                    <span class="text-white tile-peek">{{ __('backend/default.setting') }}</span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('profile.my_wish_list') }}" class="tile-wrapper">
                    <span class="tile tile-lg bg-transparent text-white mb-0" style="height: 2.3rem"><i class="fad fa-hand-holding-box"></i></span>
                    <span class="text-white tile-peek">{{ __('backend/default.wish') }}</span>
                  </a>
                </li>

                {{-- <li class="nav-item dropdown header-nav-dropdown">
                  <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link m-0"><span class="oi oi-grid-three-up"></span></a>
                </li> --}}
              </ul>

              <!-- .btn-account --> 
              <div class="navbar-nav dropdown d-flex mr-lg-n3">
                {{-- <button class="btn btn-primary mb-2 mx-0 mx-md-1 my-md-auto width-min-content" type="button" data-toggle="sidebar"><i class="fa fa-table"></i></button> --}}
                @if(Auth::guard('admin')->check())
                @php($admin = Auth::guard('admin')->user())

                  <button class="btn-account w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="user-avatar user-avatar-md mr-lg-0">
                      <img src="{{ asset($admin->photo) }}" alt="" />
                    </span>
                    <span class="account-summary d-lg-none">
                      <span class="account-name">{{ $admin->name }}</span>
                      <span class="account-description">{{-- Marketing Manager --}}</span>
                    </span>
                  </button> <!-- .dropdown-menu -->
                  <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-arrow mr-3"></div>
                    <h6 class="dropdown-header d-none d-lg-block d-lg-none bg-secondary account-name">{{ $admin->name }}</h6>
                    <a class="dropdown-item {{ Route::is('profile') ? 'active':'' }}" href="{{ route('profile') }}">
                      <span class="dropdown-icon"><i class="fad fa-user-tie"></i></span> {{ __('backend/default.profile') }}
                    </a>
                    <a class="dropdown-item" onclick="logout()" href="#">
                      <span class="dropdown-icon"><i class="fad fa-sign-out fa-flip-horizontal"></i></span> {{ __('backend/default.logout') }} 
                    </a>
                    <form id="admin-logout" style="display: none;" action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit">Logout</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Help Center</a>
                    <a class="dropdown-item" href="#">Ask Forum</a>
                    <a class="dropdown-item" href="#">Keyboard Shortcuts</a>
                  </div><!-- /.dropdown-menu -->

                @else

                  <button class="btn-account w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="user-avatar user-avatar-md mr-lg-0"><img class="grayscale-100" src="{{ asset('public/images/default.png') }}" alt=""></span>{{--  <span class="account-summary d-lg-none"><span class="account-name">Beni Arisandi</span> <span class="account-description">Marketing Manager</span></span> --}}</button> <!-- .dropdown-menu -->
                  <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-arrow mr-3"></div>
                    <a class="dropdown-item" href="{{ route('login') }}"><span class="dropdown-icon oi oi-account-login"></span> {{ __('backend/default.login') }} </a>
                    <a class="dropdown-item" href="{{ route('register') }}"><span class="dropdown-icon oi oi-cog"></span> {{ __('backend/default.signup') }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Help Center</a>
                    <a class="dropdown-item" href="#">Ask Forum</a>
                    <a class="dropdown-item" href="#">Keyboard Shortcuts</a>
                  </div><!-- /.dropdown-menu -->
                @endif
              </div><!-- /.btn-account -->
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container -->
        </nav><!-- /.navbar -->
      </header><!-- /.app-header -->
      <!-- /.app-header -->