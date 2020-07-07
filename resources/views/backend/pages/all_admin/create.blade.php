@extends('backend.layouts.master')

@section('fav_title', __('backend/admin_setting.new_admin') )

@section('styles')
<style>
    .action{
        min-width: 70px;
    }
    .table th, .table td{
        vertical-align: middle;
    }
</style>
@endsection

@section('content')

    <!-- Permission -->
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

    @endphp
    
<div class="app-title">
    <div>
        <h1><i class="fa fa-user-secret"></i> {{ __('backend/default.admin_management') }}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg fa-fw"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.all_admin.index') }}">{{ __('backend/default.admin') }}</a></li>
        <li class="breadcrumb-item active">{{ __('backend/default.add_new') }}</li>
    </ul>
</div>
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 my-auto"><h2><i class="fa fa-plus-square"></i> {{ __('backend/all.add_admin') }}</h2></div>
                    <div class="col-md-6 btn-group justify-content-end">

                        {{-- SubMenu --}}
                        @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus])

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="card-body">
                @include('backend.partials.message')
                <form class="form-horizontal" action="{{ route('admin.all_admin.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label" for="title"><strong>{{ __('backend/form_field.name') }}</strong> <span class="text-danger">*</span></label>
                            <div>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label" for="admin_role"><strong>{{ __('backend/form_field.role') }}</strong> <span class="text-danger">*</span></label>
                            <div>
                                <select name="admin_role" class="form-control" id="admin_role">
                                    <option selected value="" disabled><strong>{{ __('backend/form_field.select_role') }}</strong> </option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label" for="email"><strong>{{ __('backend/form_field.email') }}</strong>  <span class="text-danger">*</span></label>
                            <div>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label" for="username"><strong>{{ __('backend/form_field.username') }}</strong>  <span class="text-danger">*</span></label>
                            <div>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label" for="photo"><strong>{{ __('backend/form_field.photo') }}</strong>  <span class="text-danger">*</span></label>
                            <div>
                                <input type="file" class="form-control" name="photo" id="photo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label" for="password"><strong>{{ __('backend/form_field.password') }}</strong>  <span class="text-danger">*</span></label>
                            <div>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label" for="status"><strong>{{ __('backend/form_field.status') }}</strong>  <span class="text-danger">*</span></label>
                            <div>
                                <select name="status" class="form-control" id="status">
                                    <option value='1'>{{ __('backend/default.active') }}</option>
                                    <option value='0'>{{ __('backend/default.inactive') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 mt-lg-auto">
                            <button type="submit" class="btn btn-primary float-right">{{ __('backend/default.submit') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection
