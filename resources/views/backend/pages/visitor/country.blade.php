@extends('backend.layouts.master')

@section('fav_title', __('backend/visitor.visitor') )

@section('styles')
@endsection

@section('content')
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
  $mySubMenus         = $myRole ? json_decode($myRole->sub_menu):[];
@endphp

<div class="app-title">
  <div>
    <h1><i class="{{ 'fa fa-blind' }}"></i> {{ __('backend/visitor.visitor') }} {{ __('backend/default.management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('backend/visitor.visitor') }}</li>
  </ul>
</div>

<!-- Table Part -->
<div class="row">
  <div class="col-md-12">
    <div class="card">

      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="{{ 'fa fa-address-book-o' }}"></i> {{ __('backend/visitor.visitor_list') }}</h2></div>
          <div class="col-md-6 btn-group justify-content-end">

            {{-- SubMenu --}}
            {{-- @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus]) --}}
            <a href="{{ route('admin.visitor.index') }}" title="Country Wise" class="btn btn-primary">IP Visitor</a>
            <a href="{{ route('admin.visitor.country') }}" title="Country Wise" class="btn btn-primary active">Country Visitor</a>
                  
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="card-body" data-my-table="table-1">

        <form action="" method="post" class="mb-2" accept-charset="utf-8">
          @csrf

          <div class="form-row">
            <div class="col-md-2">
              <div class="form-group d-flex mb-0">
                <input title="From" autocomplete="off" value="{{ $from }}" class="pl-1 pr-0 py-1 border-right-0 rounded-0 form-control datefrom" type="text" name="from" id="datefrom" placeholder="From">
                <input title="To" autocomplete="off" value="{{ $to }}" class="pl-1 pr-0 py-1 border-left-0 rounded-0 form-control dateto" type="text" name="to" id="dateto" placeholder="To">
              </div>
            </div>
            <div class="col-md-1 text-right">
              <input class=" px-1 py-1 br-2 btn btn-primary" type="submit" value="{{ __('backend/default.search') }}">
            </div>
          </div>
        </form>

        {{-- ERROR Message --}}
        @include('backend.partials.error_message')

        <div class="toggle-table-column alert-info br-2 p-2 mb-2">
          <strong>{{ __('backend/default.table_toggle_message') }} </strong>

          <a href="#" class="toggle-vis" data-column="0"><b>{{ __('backend/default.sl') }}</b></a> |
          <a href="#" class="toggle-vis" data-column="1"><b>Code</b></a> |
          <a href="#" class="toggle-vis" data-column="2"><b>Country</b></a> |
          <a href="#" class="toggle-vis" data-column="3"><b>{{ __('backend/default.total') }}</b></a>

        </div>


        <div class="table-responsive pt-1">

          <table {{-- id="my-table" --}} id="datatable" class="table table-bordered table-hover rounded display">
            <thead>
              <th>{{ __('backend/default.sl') }}</th>
              <th>Code</th>
              <th>Country</th>
              <th>{{ __('backend/default.total') }}</th>
            </thead>

            <tbody>
              @php
                // $all = json_decode(file_get_contents('https://restcountries.eu/rest/v2/all'));
                // $countries = [];
                // foreach ($all as $element){
                //   $countries[$element->alpha2Code] = $element;
                // }
                $total = 0;
              @endphp
              @foreach($countryWise as $element)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $element->country }}</td>
                <td>{{ $element->country }}</td>
                <td>{{ $element->total }}</td>
              </tr>
              @php($total += $element->total)
              @endforeach
              <tr class="alert-secondary">
                <td colspan="3">Total</td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td>{{ $total }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection
