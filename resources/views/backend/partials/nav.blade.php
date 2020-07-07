    <header class="app-header">
      <a class="app-header__logo" href="{{ route('admin.home') }}">{{ $role_name }} <i class="{!! env('APP_DEVELOPER_TOOL') ? 'fa fa-bug fa-2x position-absolute text-primary':'' !!}"></i></a>
      <!-- Sidebar toggle button-->
      <a id='app-sidebar__toggle' class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

      <!-- Navbar Left Menu-->
      @php
        $left_top_menu_4 = \App\Helpers\ModuleHelper::get_menu_by_position('4');
        $right_top_menu_2 = \App\Helpers\ModuleHelper::get_menu_by_position('2');
        if(Auth::guard('admin')->user()->admin_role == 3) {
          $permissions = \App\Models\Role::where('admin_id', Auth::guard('admin')->user()->id)->first();
        } else {
          $permissions = \App\Models\Role::where('role', Auth::guard('admin')->user()->admin_role)->first();
        }

        if(!empty($permissions)){
          $my_menu          = json_decode($permissions->menu) != null ? json_decode($permissions->menu):[];
          $my_sub_menu      = json_decode($permissions->sub_menu) != null ? json_decode($permissions->sub_menu):[];
          $my_in_body       = json_decode($permissions->in_body) != null ? json_decode($permissions->in_body):[];
          $my_inner_in_body = json_decode($permissions->inner_in_body) != null ? json_decode($permissions->inner_in_body):[];
        } else {
          $my_menu          = [];
          $my_sub_menu      = [];
          $my_in_body       = [];
          $my_inner_in_body = [];
        }

        $count_notification = \App\Models\Message::where('admin_id', \Auth::guard('admin')->user()->id)
          ->where('status', '1')
            ->get()
              ->count();
        $count_system_message = \App\Models\SystemMessage::where('admin_id', \Auth::guard('admin')->user()->id)
          ->where('status', '1')
            ->get()
              ->count();
        // dd($count_system_message);
      @endphp

      <ul class="app-custom-nav pl-0">
        @foreach($left_top_menu_4 as $key => $menu_4)
          @if(in_array($key, $my_menu))
            @if(!empty($menu_4['route']) && ($menu_4['route']=='home' && env('APP_FRONTEND')))
            <li>
              <a class="app-nav__custom__item" href="{{ !empty($menu_4['route']) ? route($menu_4['route']):'#' }}" target="{{ (!empty($menu_4['route']) && $menu_4['route'] == 'home') ? '_blank':'' }}">
                <i class="{{ $menu_4['icon'] }}"></i>
              </a>
            </li>
            @endif
          @endif
        @endforeach
        <li class="app-nav__item lang_pen_parent cursor-default" title="Typing Language" style="background-color: var(--nav-dark); min-width: 75px;text-align: right; display: none;"><span class="lang_pen">Eng </span><i class="fa fa-pencil"></i></li>
      </ul>
      <span class="app-nav_custom_item pt-3 px-0"></span>

      <!-- Navbar Right Menu -->
      <ul class="app-nav">
        @foreach($right_top_menu_2 as $key => $menu_2)
          {{-- @if($key == 65)
            @dd($menu_2['childs'][0]['menu'] == 'Action')
          @endif --}}
          @if(in_array($key, $my_menu) || $menu_2['allow_to_all'])
          <li class="{{ (!empty($menu_2['childs']) && $menu_2['childs'][0]['menu'] != 'Action') ? 'dropdown':'' }}">
            @php
              // $lang = json_decode($menu_2['parameter'])[0];
              $lang = Auth::guard('admin')->user()->language;
            @endphp
            <a
              class="app-nav__custom__item position-relative"
              data-toggle="{{ (!empty($menu_2['childs']) && $menu_2['childs'][0]['menu'] != 'Action') ? 'dropdown':'' }}"
              href="{{ !empty($menu_2['route']) ?
                        (
                         !empty($menu_2['parameter']) ?
                            route($menu_2['route'], (($lang == 'bn') ? 'en':'bn'))
                            :
                            route($menu_2['route'])
                        )
                        :
                        '#'
                    }}"
              target="{{ (!empty($menu_2['route']) && $menu_2['route'] == 'home') ? '_blank':'' }}"
              title="{{ (!empty($menu_2['route']) && $menu_2['route'] == 'language') ? (($lang == 'bn') ? 'Click for english':'বাংলার জন্য ক্লিক করুন'):'' }}"
            >
              <i class="
              {{
                $menu_2['icon'] == 'fa fa-envelope-o' ?
                (
                  ($count_notification > 0 || $count_system_message == 0) ?
                    'fa fa-envelope text-warning'
                    :
                    $menu_2['icon']
                )
                :
                $menu_2['icon']
              }}">
                {!!
                  (
                    (
                      !empty($menu_2['parameter'])
                      &&
                      !empty($menu_2['route'])
                    )
                    &&
                    $menu_2['route'] == 'language'
                  ) ?
                  "<sup class='position-absolute t-2 r-1'><span class='badge badge-danger p-0 px-1 text-uppercase text-white' style='font-size: 10px; padding-top: 1px !important; padding-bottom: 1px !important;'>".(($lang == 'bn') ? 'ENG':'বাংলা')."</span></sup>"
                  :
                  ""
                !!}
              </i>
            </a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right mr-0">
              @foreach($menu_2['childs'] as $k => $val)
                @if(in_array($val['id'], $my_sub_menu) && $val['menu'] != 'Action')
                <li>
                  @if(Config::get('app.locale') == 'en')
                  <a class="dropdown-item" href="{{ !empty($val['route']) ? route($val['route']):'#' }}"><i class="{{ $val['icon'] }}"></i> {{ $val['menu'] }}</a>
                  @else
                  <a class="dropdown-item" href="{{ !empty($val['route']) ? route($val['route']):'#' }}"><i class="{{ $val['icon'] }}"></i> {{ $val['menu_bn'] }}</a>
                  @endif
                </li>
                @endif
              @endforeach
              @if($menu_2['menu'] == 'Profile')
              <hr class="my-0">
              <li>
                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> {{ __('backend/sidebar.logout') }}</a>
              </li>
              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              @endif
            </ul>
          </li>
          @endif
        @endforeach

        {{--
          <li class="app-nav__item lang_pen_parent" style="background-color: rgb(6, 114, 104); min-width: 75px;text-align: right; display: none;"><span class="lang_pen">Eng </span><i class="fa fa-pencil"></i></li>
          <li class="app-nav__item" style="padding: 12px 15px">
            @if(Config::get('app.locale') == 'bn')
            <a href="{{ route('language', 'en') }}">
              <img src="{{ asset('public/images/flag/en.png') }}" width="26" height="26" title="Click for english">
            </a>
            @else
            <a href="{{ route('language', 'bn') }}">
              <img src="{{ asset('public/images/flag/bn.png') }}" width="26" height="26" title="বাংলার জন্য ক্লিক করুন">
            </a>
            @endif
          </li>
          <!--Notification Menu-->
          <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-envelope fa-lg"></i></a>
          </li>
        --}}

        <!-- User Menu-->
        {{-- <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu" style="padding: 10px 15px">
          <img class="img" src="{{ asset(Auth::guard('admin')->user()->photo) }}" alt="👨" width="30" height="30" ></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right mr-0" style="width: 180px">
            @if(Auth::guard('admin')->user()->admin_role == 1)
            <li><a class="dropdown-item" href="{{ route('admin.all_admin.index') }}"><i class="fa fa-users"></i> {{ __('backend/all.my_admins') }}</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.all_admin.add') }}"><i class="fa fa-plus"></i> {{ __('backend/all.add_admin') }}</a></li>
            @endif
            <hr class="my-0">
            <li><a class="dropdown-item" href="{{ route('admin.password.form') }}"><i class="fa fa-cog"></i> {{ __('backend/admin_setting.change_password') }}</a></li>
            <hr class="my-0">
            <li><a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> {{ __('backend/sidebar.logout') }}</a></li>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </ul>      
        </li> --}}
      </ul>
    </header>
