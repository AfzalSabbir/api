
  @php
    $permissions = \App\Models\Menu::orderBy('id', 'desc')->where('url', substr(url()->current(), 1+strlen(url('/'))))->orWhere('url', substr(url()->current(), strlen(url('/'))))->first();

    // 3 is user role
    if (Auth::guard('admin')->user()->admin_role == 3) {
      $myRole = \App\Models\Role::where('admin_id', Auth::guard('admin')->user()->id)->first();
    } else {
      $myRole = \App\Models\Role::where('role', Auth::guard('admin')->user()->admin_role)->first();
    }

    //get SubMenus
    $thisRoute          = \Request::route()->getName();
    $sub_menu_by_route  = \App\Helpers\ModuleHelper::get_menu_by_route($thisRoute);
    $thisSubMenus       = current($sub_menu_by_route)['childs'];
    $mySubMenus         = json_decode($myRole->sub_menu);
    // dd($thisRoute, $sub_menu_by_route, $thisSubMenus, $mySubMenus);
    /*Session::put('permissions', $permissions);
    Session::put('myRole', $myRole);
    Session::put('thisRoute', $thisRoute);
    Session::put('sub_menu_by_route', $sub_menu_by_route);
    Session::put('thisSubMenus', $thisSubMenus);
    Session::put('mySubMenus', $mySubMenus);*/

  @endphp