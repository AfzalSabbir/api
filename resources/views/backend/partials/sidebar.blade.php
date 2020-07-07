<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar {{ $site_setting->custom_scroll == 1 ? 'of-y-hidden':'' }}">
  <div {{ $site_setting->custom_scroll == 1 ? 'data-simplebar':'' }} class="h-100">

    @includeWhen(env('APP_DEVELOPER_TOOL'), 'backend.pages.root.Importants.developer')

    {{--
      <div class="d-none">
        <a id="_me_" class="_me_ btn btn-danger" href="#me_">ME</a>
      </div>
    --}}

    @if($site_setting->show_user_data == 1)
      <div class="app-sidebar__user mb-0 bg-primary"><img class="app-sidebar__user-avatar" src="{{ file_exists(Auth::guard('admin')->user()->photo) ? asset(explode('.', Auth::guard('admin')->user()->photo)[0].'_short.'.explode('.', Auth::guard('admin')->user()->photo)[1]):asset('public/images/default_short.png') }}" alt="">
        <div>
          <p class="app-sidebar__user-name">{{ ucfirst(Auth::guard('admin')->user()->name) }}</p>
          <p class="app-sidebar__user-designation">{{ \Config::get('custom')['role'][Auth::guard('admin')->user()->admin_role] }}</p>
        </div>
      </div>
    @endif
    <ul class="app-menu admin-menu">

      @php 
        $role_wise_menus = \App\Models\Role::where('role', Auth::guard('admin')->user()->admin_role)->where('admin_id', Auth::guard('admin')->user()->id)->first();
        /*Getting All Available Menus & Sorting in array*/
        $all_menus = \App\Models\Menu::where('status', 1)->where('parent_id', null)->where('menu_position', 0)->get(['id','order'])->toArray();
        foreach ($all_menus as $key => $all_menu) {
          $_menus[$all_menus[$key]['id']] = $all_menus[$key]['order'];
        }
        asort($_menus);
      @endphp
      
      @if($role_wise_menus)
        @php
          /*decode menus and submenus*/
          $role_menus = json_decode($role_wise_menus->menu);
          $role_sub_menus = json_decode($role_wise_menus->sub_menu);

          /*Escaping from Un-necessary Sidemenus and Sorting*/
          $i = 0;
          foreach ($_menus as $key => $_menu_) {
            $role_menu_temp[$i] = $key;
            $i++;
          }
          foreach ($role_menu_temp as $key => $value) {
            if (!empty($role_menus) && !in_array($value, $role_menus)) {
              unset($role_menu_temp[$key]);
            }
          }
          $role_menus = $role_menu_temp;
        @endphp

        @foreach($role_menus as $role_menu)

          @php
            /*retrieve row for the menu_id*/
            $menu = \App\Models\Menu::roleMenu($role_menu);
          @endphp

          {{-- if it is the menu (not submenu) --}}
          @if(is_null($menu->parent_id) && $menu->menu_position != 2)

            @php
              $menu_all_submenus = $menu->submenus;
            @endphp

            @if($menu->route)

              @php
                if(Route::is($menu->route)){
                  $id = 'me_';
                } else {
                  $id = '';
                }
              @endphp
              <li>
                <a id="{{ $id }}" class="app-menu__item target-item {{ Route::is($menu->route) ? 'active' : '' }}
                  @foreach($menu_all_submenus as $submenus)
                  {{ Route::is($submenus->route) ? 'active' : '' }}
                  @foreach($submenus->submenus as $in_body)
                  {{ Route::is($in_body->route) ? 'active' : '' }}
                  @endforeach
                  @endforeach
                  " href="{{ route($menu->route) }}" style="position: relative;"><i class="app-menu__icon py-1 {{ $menu->icon }}" style="color: {{ Route::is($menu->route) ? '#000':$menu->icon_color }};"></i><span class="app-menu__label"> {{-- sigle --}} @if(Config::get('app.locale') == 'en') {{ $menu->menu }} @else {{ $menu->menu_bn }} @endif </span>
                  <span class="hover-animation"></span>
                </a>
              </li>
            @else
              <li id="{{ str_slug($menu->menu) }}" class="treeview
                @foreach($menu_all_submenus as $submenus)
                  {{ Route::is($submenus->route) ? 'is-expanded' : (strpos(Request::fullUrl().'/', $submenus->url.'/') !== false ? 'is-expanded' : '') }}
                  @foreach($submenus->submenus as $in_body)
                    {{ Route::is($in_body->route) ? 'is-expanded' : '' }}
                  @endforeach
                @endforeach ">

                <a class="app-menu__item
                  @foreach($menu_all_submenus as $submenus)
                    {{ Route::is($submenus->route) ? 'app-menu__item_2' : '' }}
                    @foreach($submenus->submenus as $in_body)
                    {{ Route::is($in_body->route) ? 'app-menu__item_2' : '' }}
                    @endforeach
                  @endforeach

                " href="#{{ str_slug($menu->menu) }}" data-toggle="treeview"
                  @foreach($menu_all_submenus as $submenus)
                    {{ Route::is($submenus->route) ? 'active' : '' }}
                    @foreach($submenus->submenus as $in_body)
                    {{ Route::is($in_body->route) ? 'active' : '' }}
                    @endforeach
                  @endforeach style="position: relative;">
                  <i class="app-menu__icon py-1 {{ $menu->icon }}" style="color: {{ Route::is($menu->route) ? '#000':$menu->icon_color }};"></i>
                  <span class="app-menu__label">@if(Config::get('app.locale') == 'en') {{ $menu->menu }} @else {{ $menu->menu_bn }} @endif</span>
                  <i class="treeview-indicator fa fa-angle-left"></i> {{-- double --}}
                  <span class="hover-animation"></span>
                </a>
                <ul class="treeview-menu">
                  @foreach($menu_all_submenus as $submenu)
                  @if(\App\Models\Menu::existForRole($submenu->id, $role_sub_menus))

                  @php
                  if(Route::is($submenu->route)){ 
                    $id = 'me_';
                  }else{
                    $id = '';
                    foreach($submenu->submenus as $in_body){
                      if(Route::is($in_body->route)){ 
                        $id = 'me_';
                        break;
                      }else{
                        $id = '';
                      }
                    }
                  }
                  @endphp

                  <li>
                    <a id="{{ $id }}" class="treeview-item target-item {{ Route::is($submenu->route) ? 'active_submenu' : (strpos($submenu->url, 'add') !== false ? (strpos(Request::fullUrl().'/', $submenu->url.'/') !== false ? 'active_submenu' : $submenu->url) : '') }}
                    @foreach($submenu->submenus as $in_body)
                    {{ Route::is($in_body->route) ? 'active_submenu' : '' }}
                    @endforeach" href="{{ route($submenu->route) }}" style="position: relative;"><i class="icon {{ $submenu->icon }}" style="color: {{ Route::is($submenu->route) ? '#000':$submenu->icon_color }};"></i> @if(Config::get('app.locale') == 'en') {{ $submenu->menu }} @else {{ $submenu->menu_bn }} @endif
                    <span class="hover-animation"></span>
                    </a>
                  </li>
                  @endif
                  @endforeach
                </ul>
              </li>
            @endif
          @endif
        @endforeach
      @endif
    </ul>
  </div>
</aside>