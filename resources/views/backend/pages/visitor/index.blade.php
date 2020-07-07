@extends('backend.layouts.master')

@section('fav_title', __('backend/default.visitor') )

@section('styles')
<style>
  .datepicker.datepicker-dropdown.dropdown-menu {
    width: 220px !important;
  }
</style>
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
    <h1><i class="{{ 'fa fa-blind' }}"></i> {{ __('backend/default.visitor') }} {{ __('backend/default.management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('backend/default.visitor') }}</li>
  </ul>
</div>

<!-- Table Part -->
<div class="row">
  <div class="col-md-12">
    <div class="card">

      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="{{ 'fa fa-address-book-o' }}"></i> {{ __('backend/default.visitor_list') }}</h2></div>
          <div class="col-md-6 btn-group justify-content-end">

            {{-- SubMenu --}}
            {{-- @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus]) --}}

            <a href="{{ route('admin.visitor.index') }}" title="Country Wise" class="btn btn-primary active">IP Visitor</a>
            <a href="{{ route('admin.visitor.country') }}" title="Country Wise" class="btn btn-primary">Country Visitor</a>
                  
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="card-body" data-my-table="table-1">

        <form action="" method="post" class="mb-2" accept-charset="utf-8">
          @csrf

          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group d-flex mb-0">
                <input title="From" autocomplete="off" value="{{ $from }}" class="pl-1 pr-0 py-1 border-right-0 rounded-0 form-control" type="text" name="from" id="datefrom" placeholder="From">
                <input title="To" autocomplete="off" value="{{ $to }}" class="pl-1 pr-0 py-1 border-left-0 rounded-0 form-control" type="text" name="to" id="dateto" placeholder="To">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group d-flex mb-0">
                <input title="URL" autocomplete="off" value="{{ !empty($url)?$url:'' }}" class="pl-1 pr-0 py-1 rounded-0 form-control" type="text" name="url" id="url" placeholder="url">
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
          <a href="#" class="toggle-vis" data-column="1"><b>IP</b></a> |
          <a href="#" class="toggle-vis {{-- hide-on-load --}}" data-column="2"><b>{{ __('backend/default.total') }}</b></a> |
          <a href="#" class="toggle-vis" data-column="3"><b>{{ __('backend/default.action') }}</b></a>

        </div>

          
        <div class="table-responsive pt-1">

          <table {{-- id="my-table" --}} id="datatable" class="table table-bordered table-hover rounded display">
            <thead>
              <th width="20px">{{ __('backend/default.sl') }}</th>
              <th>IP</th>
              <th>Last Visit</th>
              <th>Last Visited</th>
              <th class="text-center">{{ __('backend/default.total') }}</th>
              <th width="60px" class="action">{{ __('backend/default.action') }}</th>
            </thead>
            <tbody>
              @foreach($rows as $ip=> $row)
              <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $ip }}</td>
                <td>{{ n2l(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', current($row)['created_at'])->diffForHumans()) }}</td>
                <td><a href="{{ asset(current($row)['url']) }}" title="" target="_blank">{{ current($row)['url'] }}</a></td>
                <td class="text-center">{{ count($row) }}</td>
                <td class="action">
                  <div class="btn-group">
                    @foreach(current($thisSubMenus)['childs'] as $key => $in_body)
                      @if(\App\Models\Menu::checkBodyMenu($in_body['id'], $myRole?$myRole->in_body:[]))
                        @if($key == 0)
                          <button title="View" data-toggle="modal" data-target="#view_detail_{{ preg_replace('/[\.\:]/', '-', $ip) }}" class="btn btn-info text-white"><i class="fa fa-eye"></i></button>
                        @elseif($key == 1)
                          <button title="Edit" data-toggle="modal" data-target="#edit_detail_{{ preg_replace('/[\.\:]/', '-', $ip) }}" class="btn btn-warning text-white" disabled><i class="fa fa-edit"></i></button>
                        @else
                          <button title="Delete" class="btn text-white btn-secondary" onClick="deleteMethod('{{ '' }}')" role="button" disabled><i class="fa fa-trash"></i></button>
                        @endif
                      @endif
                    @endforeach
                  </div>
                  <!-- View -->
                  <div class="modal fade" id="view_detail_{{ preg_replace('/[\.\:]/', '-', $ip) }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square"></i> {{ __('backend/default.visitor') }} {{ __('backend/default.detail') }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th colspan="4">{{ $ip }} ({{ n2l(count($row)) }})</th>
                              </tr>

                              <tr>
                                <th colspan="4">Last visited: {{ n2l(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', current($row)['created_at'])->diffForHumans()) }}</th>
                              </tr>
                              @if(strlen($ip) > 7)
                              <tr>
                                <th colspan="4">
                                  <div class="row">
                                    @php
                                      $thisIpDetail = count($rows) > 100 ? '':\Location::get($ip);
                                    @endphp
                                    @if(is_array($thisIpDetail) || is_object($thisIpDetail))
                                      @foreach ($thisIpDetail as $key=> $element)
                                        <div class="col-md-6 text-left">{{ $key }}: <span class="font-weight-normal">{{ $element }}</span></div>
                                      @endforeach
                                    @else
                                        <div class="col-md-6 text-left">Check Manually: {{ $ip }}</div>
                                    @endif
                                  </div>
                                </th>
                              </tr>
                              @endif
                              <tr>
                                <th>#</th>
                                <th>url</th>
                                <th>time</th>
                                <th>user</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($row as $element)
                                <tr>
                                  <td>{{ $loop->index+1 }}</td>
                                  <td class="text-left"><a href="{{ asset($element['url']) }}" title="" target="_blank">{{ $element['url'] }}</a></td>
                                  <td>{{ n2l(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $element['created_at'])->diffForHumans()) }}</td>
                                  <td class="text-center">{{ $element['admin_id'] }}</td>
                                </tr>
                              @endforeach

                              <tr>
                                <th colspan="4">Last visiting detail ( {{ n2l(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', current($row)['created_at'])->diffForHumans()) }} )</th>
                              </tr>
                              <tr>
                                <th colspan="4">
                                  <div class="row">
                                    @foreach (current($row) as $a=> $b)
                                      <div class="col-md-4 text-left">{{ ucwords(str_replace('_', ' ', $a)) }}: <span class="font-weight-normal">{{ $b }}</span></div>
                                    @endforeach
                                  </div>
                                </th>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
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
