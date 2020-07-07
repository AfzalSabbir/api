{{-- @php
  $role_ = Auth::user()->admin_role;
  $route_ = \Request::route()->getName();

  /**
   * Exceptions (Not in DB)
  **/
  if ($route_ == 'admin.role.assign_user') {
    $route_ = 'admin.role.assign';
  }

  //$admins = Admin::orderBy('id', 'desc')->where('admin_role', $role_)->where('status', 1)->get();
  $getThisMenu = \App\Models\Menu::where('route', $route_)->where('status', 1)->first();
  $getMyRoles = \App\Models\Role::where('admin_id', Auth::id())->where('role', $role_)->where('status', 1)->first();

  $getMyMenuRoles = json_decode($getMyRoles->menu);
  $getMySubMenuRoles = json_decode($getMyRoles->sub_menu);
  $getMyInBodyRoles = json_decode($getMyRoles->in_body);

  
  
  $assign_id = $getThisMenu->id;

  $found = 0;
@endphp

@php
  foreach ($getMyMenuRoles as $getMyMenuRole) {
    if ($getMyInBodyRole == $assign_id) {
      $found = 1;
    }
  }
@endphp
@if ($found == 0)
  <script type="text/javascript">
    $('body').hide();
    history.go(-1);
  </script>
@endif

@php
  foreach ($getMyInBodyRoles as $getMyInBodyRole) {
    if ($getMyInBodyRole == $assign_id) {
      $found = 1;
    }
  }
@endphp
@if ($found == 0)
  <script type="text/javascript">
    $('body').hide();
    history.go(-1);
  </script>
@endif

@php
  foreach ($getMyInBodyRoles as $getMyInBodyRole) {
    if ($getMyInBodyRole == $assign_id) {
      $found = 1;
    }
  }
@endphp
@if ($found == 0)
  <script type="text/javascript">
    $('body').hide();
    history.go(-1);
  </script>
@endif --}}