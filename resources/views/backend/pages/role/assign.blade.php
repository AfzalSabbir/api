@extends('backend.layouts.master')

@section('fav_title', __('backend/default.assign_permission') )

@section('styles')
<style type="text/css">
  .methods > .each_method{
    float: left;
    width: 184px;
    padding: 2px 0;
    /* padding-left: 1rem !important */
  }
  .method_ {
    padding-left: 1.5rem !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
  }
  label {
    margin-bottom: 1px;
    white-space: nowrap;
  }
  input {
    vertical-align: sub !important;
    z-index: 10;
    cursor: pointer;
  }
  /* .position-relative:hover {
    color: green;
    cursor: pointer;
  }
  .position-relative:hover .position-relative:hover,
  .position-relative:hover .position-relative:hover ~ div {
    color: red;
    cursor: pointer;
  }
  .position-relative:hover .position-relative:hover .position-relative:hover {
    color: blue;
    cursor: pointer;
  }
  .position-relative:hover .position-relative:hover .position-relative:hover .position-relative:hover {
    color: yellow;
    cursor: pointer;
  } */
</style>
@include('backend/partials/style_custom_check')
@endsection

@section('content')
@include('backend.partials.permission_checker')
@php
  /*
    {{--
      SuperAdmin id must be 1 in table
  */
  $admins = \App\Models\Admin::orderBy('id', 'asc')->where('admin_role', $role)->where('status', 1)->get();
  /*
      Admin id must be 2 in table
    --}}
  */
  $hasAuthority = \App\Models\Menu::where('route', 'admin.role.assign.super_admin')->where('status', 1)->first();
  $getMyRoles = \App\Models\Role::where('admin_id', Auth::guard('admin')->id())->where('role', Auth::guard('admin')->user()->admin_role)->where('status', 1)->first();
  $assign_id = $hasAuthority->id;

  $found = 0;

  if ($getMyRoles && Auth::guard('admin')->user()->username == 'superadmin') {
    $getMyInBodyRoles = json_decode($getMyRoles->in_body);

    foreach ($getMyInBodyRoles as $getMyInBodyRole) {
      if ($getMyInBodyRole == $assign_id) {
        $found = 1;
      }
    }
  }
  if (Auth::guard('admin')->user()->username == 'superadmin') {
    $found = 1;
  }
  
  $role_ = ucwords(request()->segment(count(request()->segments())), '-');
  $role_ = substr(str_replace('-',' ', $role_), 0, strlen($role_));
@endphp
{{-- @if ($found == 0)
  <script type="text/javascript">
    $('body').hide();
    history.go(-1);
  </script>
@endif --}}

<div class="app-title">
  <div>
    <h1><i class="fa fa-diamond"></i> {{ $admins[0]->name.' '.__('backend/default.management') }}</h1>
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
          <div class="col-md-6 my-auto"><h2><i class="fa fa-table"> </i> {{ ucfirst($admins[0]->name) }}</h2></div>
        </div>
      </div>
      <div class="card-body">
        @php
          $permissions = \App\Models\Menu::orderBy('id', 'desc')->where('url', substr(url()->current(), 1+strlen(url('/'))))
          ->orWhere('url', substr(url()->current(), strlen(url('/'))))->first();
          $myRoleAccess = \App\Models\Role::where('role', Auth::guard('admin')->user()->admin_role)->first();
          $thisRoleAccess = \App\Models\Role::where('role', $role)->first();
        @endphp
        <form action="{{ route('admin.role.store') }}" method="post">
          @csrf

          @if($role == 3)
          <div class="row">
            <div class="col-md-3">
              <select name="admin_id" id="admin_id" class="form-control" required>
                <option selected value="" disabled>Select User</option>
                @foreach($admins as $admin)
                <option value="{{ $admin->id }}" {{ $loop->index == 0 ? 'selected' : '' }}>{{ $admin->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <br>
          @else
            <input type="hidden" name="admin_id" id="admin_id" class="form-control" required value="{{ encrypt($admin_id) }}">
          @endif

          <input type="hidden" name="role_type" value="{{ $role }}">
          <table class="table table-bordered rounded">
            <thead>
              <tr>
                {{-- <th>{{ __('backend/default.comment') }}</th> --}}
                {{-- <th>{{ __('backend/menu.menu') }}</th> --}}
                {{-- <th>{{ __('backend/menu.submenu') }}</th> --}}
              </tr>
              <tr>
                <th class="alert-secondary">
                  <label class="position-relative">
                    <span class="h4 mb-0">{{ __('backend/default.comment') }}</span>
                  </label>
                </th>
                <th class="alert-secondary">
                  <label class="position-relative">
                    <span class="line5_ position-absolute"></span>
                    <span class="line6_ position-absolute"></span>
                    <input type="checkbox" class="selectAll">
                      <span class="h4 mb-0">{{ __('backend/default.select_all') }}</span>
                  </label>
                </th>
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
                $this_menu          = $thisRoleAccess != null ? json_decode($thisRoleAccess->menu):[];
                $this_sub_menu      = $thisRoleAccess != null ? json_decode($thisRoleAccess->sub_menu):[];
                $this_in_body       = $thisRoleAccess != null ? json_decode($thisRoleAccess->in_body):[];
                $this_inner_in_body = $thisRoleAccess != null ? json_decode($thisRoleAccess->inner_in_body):[];
                $comment  = [
                  'en' => ['Sidebar', 'In Body', 'Nav Right', 'Nav Right In', 'Nav Left', 'Nav Left In'],
                  'bn' => ['সাইডবার', 'ইন বডি', 'ডান নেভ', 'ডান নেভ ইন', 'বাম নেভ', 'বাম নেভ ইন']
                ];
                $color    = ['alert-success', 'alert-danger', 'alert-warning', 'alert-warning', 'alert-info', 'alert-info'];
              @endphp
              @foreach($menus as $menu)

              @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($this_menu) && in_array($menu->id, $this_menu)))
                @if(is_null($menu->parent_id))
                <tr class="{{ $color[$menu->menu_position] }}" style="{{ $menu->route == 'admin.role.index' && $role_ == 'User' ? 'background-color: #fff3cd; color: #ad7204' : '' }}" id="{{ $menu->route == 'admin.role.index' && $role_ == 'User' ? 'permission_' : '' }}">
                  <td class="alert-info py-0 {{ $color[$menu->menu_position] }}">{{ $comment[Config::get('app.locale') == 'en' ? 'en':'bn'][$menu->menu_position] }}</td>
                  <td class="method_ position-relative">

                    {{-- @if(count($menu->submenus) >= 1) --}}
                      <span class="line4_ position-absolute"></span>
                      <span class="line_long4 position-absolute"></span>
                    {{-- @endif --}}

                    @if(Config::get('app.locale') == 'en')
                    <label class="position-relative d-block cursor-pointer">
                      @if(count($menu->submenus) >= 1)
                        <span class="line3_ position-absolute"></span>
                        <span class="line_long3 position-absolute"></span>
                      @endif
                      <input type="checkbox" class="select_all" name="menu[]" id="menu{{ $menu->id }}" value="{{ $menu->id }}" {{ \App\Models\Role::checkedMenu($menu->id, $role_wise_menus) }}> {{ $menu->menu }}
                    </label>
                    @else
                    <label class="position-relative d-block cursor-pointer">
                      @if(count($menu->submenus) >= 1)
                        <span class="line3_ position-absolute"></span>
                        <span class="line_long3 position-absolute"></span>
                      @endif
                      <input type="checkbox" class="select_all" name="menu[]" id="menu{{ $menu->id }}" value="{{ $menu->id }}" {{ \App\Models\Role::checkedMenu($menu->id, $role_wise_menus) }}> {{ $menu->menu_bn }}
                    </label>
                    @endif
                    <div class="methods">
                      @foreach($menu->submenus as $submenu) {{-- Using Model --}}
                        @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($this_sub_menu) && in_array($submenu->id, $this_sub_menu)))
                        <div class="each_method ml-3 w-100 cursor-pointer">
                          <span class="line_long8 position-absolute"></span>
                          @if(Config::get('app.locale') == 'en')
                          <label class="position-relative d-block cursor-pointer">
                            <span class="line7_ position-absolute"></span>
                            <span class="line_long7 position-absolute"></span>
                            <input type="checkbox" class="submenus" name="submenu[]" id="submenu{{ $submenu->id }}" value="{{ $submenu->id }}" {{ \App\Models\Role::checkedMenu($submenu->id, $role_wise_sub_menus) }}> {{ $submenu->menu }}
                          </label>
                          @else
                          <label class="position-relative d-block cursor-pointer">
                            <span class="line7_ position-absolute"></span>
                            <span class="line_long7 position-absolute"></span>
                            <input type="checkbox" class="submenus" name="submenu[]" id="submenu{{ $submenu->id }}" value="{{ $submenu->id }}" {{ \App\Models\Role::checkedMenu($submenu->id, $role_wise_sub_menus) }}> {{ $submenu->menu_bn }}
                          </label>
                          @endif
                          @if(count($submenu->submenus) >= 1)
                          <div>
                            @foreach($submenu->submenus as $in_body)  {{-- Using Model --}}
                              @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($this_in_body) && in_array($in_body->id, $this_in_body)))
                              <label class="position-relative d-block cursor-pointer inner_each_method"><span class="line_ position-absolute"></span><span class="line_long position-absolute"></span>
                                @if(Config::get('app.locale') == 'en')
                                <input type="checkbox" class="in_body ml-3" name="in_body[]" id="inbody{{ $in_body->id }}" value="{{ $in_body->id }}" {{ \App\Models\Role::checkedMenu($in_body->id, $role_wise_in_body_menus) }}> {{ $in_body->menu }}
                                  @if(count($in_body->submenus) >= 1)
                                    <br>
                                    <div>
                                      <span class="line_long2 position-absolute"></span>
                                      @foreach($in_body->submenus as $inner_in_body)  {{-- Using Model --}}
                                        @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($this_inner_in_body) && in_array($inner_in_body->id, $this_inner_in_body)))
                                        <label class="position-relative d-block cursor-pointer"><span class="line2_ position-absolute"></span>
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
                                  @if(count($in_body->submenus) >= 1)
                                    <br>
                                    <div>
                                      <span class="line_long2 position-absolute"></span>
                                      @foreach($in_body->submenus as $inner_in_body)  {{-- Using Model --}}
                                        @if(Auth::guard('admin')->user()->admin_role == '1' || (!empty($this_inner_in_body) && in_array($inner_in_body->id, $this_inner_in_body)))
                                        <label class="position-relative d-block cursor-pointer"><span class="line2_ position-absolute"></span>
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
                                @endif
                              </label>
                              @endif
                            @endforeach
                          </div>
                          @endif
                        </div>
                        @endif
                      @endforeach
                    </div>
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
  $(document).ready(function () {
    $(".selectAll").closest('label').mouseenter(function(event) {
      $('table').css('color', 'red');
    }).mouseleave(function(event) {
      $('table').css('color', '');
    });
    $(".selectAll").change(function () {
      $("input:checkbox").prop('checked', $(this).prop("checked"));
      @if ($role_ == 'User')
        if ($(this).is(':checked')) {
          alert('Giving the Menu Permission to USERs might be dangerous !!!');
        }
      @endif
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
      var type = "{{ $role_ }}";
      type = type.toLowerCase();

      window.location.href = "{{ url('/') }}"+"/"+"{{ Session::get('site_setting')->admin_prefix }}"+"/role/assign/"+type+"/"+admin_id;
    });

  });
</script>
@endsection
