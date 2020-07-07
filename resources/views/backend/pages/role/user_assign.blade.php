@extends('backend.layouts.master')

@section('fav_title', __('backend/default.assign_permission') )

@section('styles')
<style type="text/css">
  .methods > .each_method{
    float: left;
    width: 184px;
    padding: 2px 0;
  }
  label {
    margin-bottom: 1px; 
  }
  input {
    vertical-align: sub !important;
    z-index: 10;
  }
</style>
@include('backend/partials/style_custom_check')
@endsection

@section('content')
  {{-- @include('backend.partials.permission_checker') --}}
  @php
    $admins = \App\Models\Admin::orderBy('id', 'desc')->where('admin_role', $role)->where('status', 1)->get();
    $this_admin = \App\Models\Admin::where('admin_role', $role)->where('id', $admin_id)->where('status', 1)->first();
    $hasAuthority = \App\Models\Menu::where('route', 'admin.role.assign.user')->where('status', 1)->first();
    $getMyRoles = \App\Models\Role::where('admin_id', Auth::guard('admin')->id())->where('role', Auth::guard('admin')->user()->admin_role)->where('status', 1)->first();

    if($getMyRoles) {
      $getMyInBodyRoles = json_decode($getMyRoles->in_body);

      $assign_id = $hasAuthority->id;

      $found = 0;
      if (!empty($getMyRoles->in_body) && $getMyRoles->in_body != null) {
        foreach ($getMyInBodyRoles as $getMyInBodyRole) {
          if ($getMyInBodyRole == $assign_id) {
            $found = 1;
          }
        }
      }
    }

    $role_ = ucwords(request()->segment(count(request()->segments())), '-');
    $role_ = str_replace('-',' ', $role_);
  @endphp

<div class="app-title">
  <div>
    <h1><i class="fa fa-diamond"></i> {{ $role_type.' '.__('backend/default.management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg fa-fw"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('backend/admin_setting.admin_setting') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">{{ __('backend/admin_setting.role') }}</a></li>
    <li class="breadcrumb-item active">{{ __('backend/admin_setting.assign') }}</li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="fa fa-table"> </i> {{ ucfirst($this_admin->name) }}</h2></div>
        </div>
      </div>
      <div class="card-body">
        @php
          $permissions = \App\Models\Menu::orderBy('id', 'desc')->where('url', substr(url()->current(), 1+strlen(url('/'))))
          ->orWhere('url', substr(url()->current(), strlen(url('/'))))->first();
          $myRoleAccess = \App\Models\Role::where('role', Auth::guard('admin')->user()->admin_role)->first();
          $thisRoleAccess = \App\Models\Role::where(['role' => $role, 'admin_id' => $admin_id])->first();
        @endphp
        <form action="{{ route('admin.role.store') }}" method="post">
          @csrf

          @if($role == 3)
          <div class="row">
            <div class="col-md-3">
              <select name="admin_id" id="admin_id" class="form-control" required>
                <option selected value="" disabled>Select User</option>
                @foreach(/*\App\Models\Admin::where('admin_role', $role)->where('status', 1)->get()*/ $admins as $admin)
                <option value="{{ encrypt($admin->id) }}" {{ $admin->id == $admin_id ? 'selected' : ''}}>{{ $admin->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <br>
          @endif

          <input type="hidden" name="role_type" value="{{ $role }}">
          <table class="table table-bordered table-striped rounded">
            <thead>
              <tr>
                <th>{{ __('backend/menu.menu') }}</th>
                <th>{{ __('backend/menu.submenu') }}</th>
              </tr>
              <tr>
                <th colspan="2" class="alert-secondary"><label><input type="checkbox" class="selectAll"> <span class="h3 mb-0">{{ __('backend/default.select_all') }}</span></label></th>
              </tr>
            </thead>
            <tbody>
              @php
                if(!is_null($role_wise)){
                  $role_wise_menus                = json_decode($role_wise->menu);
                  $role_wise_sub_menus            = json_decode($role_wise->sub_menu);
                  $role_wise_in_body_menus        = json_decode($role_wise->in_body);
                  $role_wise_inner_in_body_menus  = json_decode($role_wise->inner_in_body);
                } else {
                  $role_wise_menus                = array();
                  $role_wise_sub_menus            = array();
                  $role_wise_in_body_menus        = array();
                  $role_wise_inner_in_body_menus  = array();
                }
                $my_menu            = json_decode($myRoleAccess->menu);
                $my_sub_menu        = json_decode($myRoleAccess->sub_menu);
                $my_in_body         = json_decode($myRoleAccess->in_body);
                $my_inner_in_body   = json_decode($myRoleAccess->inner_in_body);

                $this_menu          = json_decode($thisRoleAccess->menu);
                $this_sub_menu      = json_decode($thisRoleAccess->sub_menu);
                $this_in_body       = json_decode($thisRoleAccess->in_body);
                $this_inner_in_body = json_decode($thisRoleAccess->inner_in_body);
                $comment = ['Sidebar', 'In Body', 'Nav Right', 'Nav Right In', 'Nav Left', 'Nav Left In'];
              @endphp
              @foreach($menus as $menu)
              @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($this_menu) && in_array($menu->id, $this_menu)) || (!empty($my_menu) && in_array($menu->id, $my_menu)))
              {{--
              --  Active to if only give access you are accessable to --
              --}}
              {{-- @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($my_menu) && in_array($menu->id, $my_menu))) --}}
                @if(is_null($menu->parent_id))
                <tr style="{{ $menu->route == 'admin.role.index' ? 'background-color: #fff3cd; color: #ad7204' : '' }}" id="{{ $menu->route == 'admin.role.index' ? 'permission_' : '' }}">
                  <td class="method_">  
                    @if(Config::get('app.locale') == 'en')
                    <label><input type="checkbox" class="select_all" name="menu[]" id="menu{{ $menu->id }}" value="{{ $menu->id }}" {{ \App\Models\Role::checkedMenu($menu->id, $role_wise_menus) }}> {{ $menu->menu }}</label>
                    @else
                    <label><input type="checkbox" class="select_all" name="menu[]" id="menu{{ $menu->id }}" value="{{ $menu->id }}" {{ \App\Models\Role::checkedMenu($menu->id, $role_wise_menus) }}> {{ $menu->menu_bn }}</label>
                    @endif
                  </td>
                  <td class="methods">
                    @foreach($menu->submenus as $submenu)
                      @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($this_sub_menu) && in_array($submenu->id, $this_sub_menu)) || (!empty($my_sub_menu) && in_array($submenu->id, $my_sub_menu)))
                      {{--
                      --  Active to if only give access you are accessable to --
                      --}}
                      {{-- @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($my_sub_menu) && in_array($submenu->id, $my_sub_menu))) --}}
                      <div class="each_method">
                        @if(Config::get('app.locale') == 'en')
                        <label><input type="checkbox" class="submenus" name="submenu[]" id="submenu{{ $submenu->id }}" value="{{ $submenu->id }}" {{ \App\Models\Role::checkedMenu($submenu->id, $role_wise_sub_menus) }}> {{ $submenu->menu }}</label>
                        @else
                        <label><input type="checkbox" class="submenus" name="submenu[]" id="submenu{{ $submenu->id }}" value="{{ $submenu->id }}" {{ \App\Models\Role::checkedMenu($submenu->id, $role_wise_sub_menus) }}> {{ $submenu->menu_bn }}</label>
                        @endif
                        @if(count($submenu->submenus) >= 1)
                        <br>
                        <div>
                          @foreach($submenu->submenus as $in_body)
                            @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($this_in_body) && in_array($in_body->id, $this_in_body)) || (!empty($my_in_body) && in_array($in_body->id, $my_in_body)))
                            {{--
                            --  Active to if only give access you are accessable to --
                            --}}
                            {{-- @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($my_in_body) && in_array($in_body->id, $my_in_body))) --}}
                            <label class="position-relative d-block"><span class="line_ position-absolute"></span><span class="line_long position-absolute"></span>
                              @if(Config::get('app.locale') == 'en')
                              <input type="checkbox" class="in_body ml-3" name="in_body[]" id="inbody{{ $in_body->id }}" value="{{ $in_body->id }}" {{ \App\Models\Role::checkedMenu($in_body->id, $role_wise_in_body_menus) }}> {{ $in_body->menu }}

                                @if(count($in_body->submenus) >= 1)
                                  <br>
                                  <div>
                                    <span class="line_long2 position-absolute"></span>
                                    @foreach($in_body->submenus as $inner_in_body)  {{-- Using Model --}}
                                      @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($this_inner_in_body) && in_array($inner_in_body->id, $this_inner_in_body)))
                                      <label class="position-relative d-block"><span class="line2_ position-absolute"></span>
                                        @if(Config::get('app.locale') == 'en')
                                        <input type="checkbox" class="inner_in_body ml-3" name="inner_in_body[]" id="inner_inbody{{ $inner_in_body->id }}" value="{{ $inner_in_body->id }}" {{ \App\Models\Role::checkedMenu($inner_in_body->id, $role_wise_inner_in_body_menus) }}> {{ $inner_in_body->menu }}
                                        @else
                                        <input type="checkbox" class="inner_in_body ml-3" name="inner_in_body[]" id="inner_inbody{{ $inner_in_body->id }}" value="{{ $inner_in_body->id }}" {{ \App\Models\Role::checkedMenu($inner_in_body->id, $role_wise_inner_in_body_menus) }}> {{ $inner_in_body->menu_bn }}
                                        @endif
                                      </label>
                                      @endif
                                    @endforeach
                                  </div>
                                @endif
                              @else
                              <input type="checkbox" class="in_body ml-3" name="in_body[]" id="inbody{{ $in_body->id }}" value="{{ $in_body->id }}" {{ \App\Models\Role::checkedMenu($in_body->id, $role_wise_in_body_menus) }}> {{ $in_body->menu_bn }}
                              @endif
                            </label>
                            @endif
                          @endforeach
                        </div>
                        @endif
                      </div>
                      @endif
                    @endforeach
                  </td>
                </tr>
                @endif
              @endif
              @endforeach
            </tbody>
          </table>
          <button type="submit" class="btn btn-success float-right" id="button">{{ __('backend/default.save') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(".treeview-item").find('.fa-user').css('color', '#000').closest('a').addClass('active_submenu');
  $(document).ready(function () {
    /*var find_active = $(".treeview-item").find('.fa-user');
    console.log(find_active.css('color', '#000'), find_active.closest('a').addClass('active_submenu'));*/

    $(".selectAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      if ($(this).is(':checked')) {
        alert('Giving the Menu Permission to USERs might be dangerous !!!');
      }
    });
    $(document).on('change', '.select_all', function () {
      var change = $(this);
      $(this).closest('tr').find('.methods').find('input').each(function () {
        if (change.is(':checked')) {
          $(this).prop('checked', true);
          $.fn.myFunction();
        }
        else {
          $(this).prop('checked', false);
          $.fn.myFunction();
        }
      });
    });
    $(document).on('change', '#permission_ input', function () {
      if ($(this).is(':checked')) {
        alert('Giving the Menu Permission to USERs might be dangerous !!!');
      }
      else {
      }
    });
    $(document).on('change', '.submenus', function () {
      var change = $(this);
      $(this).closest('div').find('input').each(function () {
        if (change.is(':checked')) {
          $(this).prop('checked', true);
          $.fn.myFunction();
        }
        else {
          $(this).prop('checked', false);
          $.fn.myFunction();
        }
      });
    });

    $(document).on('change', '.in_body', function () {
      var change = $(this);
      $(this).siblings('div').find('input').each(function () {
        if (change.is(':checked')) {
          $(this).prop('checked', true);
          $.fn.myFunction();
        }
        else {
          $(this).prop('checked', false);
          $.fn.myFunction();
        }
      });
    });

    $("tbody input:checkbox").change(function () {
      $.fn.myFunction();
    });
    if($('input:checked').length == ($('input[type=checkbox]').length - 1) && $('.selectAll:checked').length != 1){
      $('.selectAll').prop('checked', true);
    }
    $.fn.myFunction = function() {

      if($('tbody input:checked').length == ($('tbody input[type=checkbox]').length)){
        console.log("if "+($('tbody input:checked').length) +' '+ ($('tbody input[type=checkbox]').length))
        $('.selectAll').prop('checked', true);
        
      } else if($('tbody input:checked').length != ($('tbody input[type=checkbox]').length)){
        console.log("else "+($('tbody input:checked').length) +' '+ ($('tbody input[type=checkbox]').length))
        $('.selectAll').prop('checked', false);
      }
    }

    $("#admin_id").change(function(){
      var admin_id = $(this).val();
      var type = "{{ $role_type }}";
      type = type.toLowerCase();

      window.location.href = "{{ url('/') }}"+"/"+"{{ Session::get('site_setting')->admin_prefix }}"+"/role/assign/"+type+"/"+admin_id;
    });

  });
</script>
@endsection
