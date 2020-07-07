<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/message.all_message') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
<!-- Top Management Part -->

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
    <h1><i class="{{ 'fa fa-envelope-square' }}"></i> {{ __('backend/message.message_management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('backend/message.message') }}</li>
  </ul>
</div>

<!-- Table Part -->
<div class="row">
  <div class="col-md-12">
    <div class="card">

      <div class="card-header">
        <div class="row">
          <div class="col-md-6"><h2><i class="{{ 'fa fa-table' }}"></i> {{ __('backend/message.all_message') }}</h2></div>
          <div class="col-md-6 btn-group justify-content-end">

            {{-- SubMenu --}}
            @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus])
                  
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="card-body" data-my-table="table-1">

        {{-- ERROR Message --}}
        @include('backend.partials.error_message')

        <div class="toggle-table-column alert-info br-2 p-2 mb-2">
          <strong>{{ __('backend/default.table_toggle_message') }} </strong>

          <a href="#" class="toggle-vis" data-column="0"><b>{{ __('backend/default.sl') }}</b></a> |
          <a href="#" class="toggle-vis" data-column="1"><b>{{ __('backend/default.message') }}</b></a>
          {{-- <a href="#" class="toggle-vis hide-on-load" data-column="2"><b>{{ __('backend/default.action') }}</b></a> --}}

        </div>
        <div class="table-responsive pt-1">
          @include('backend.partials.pagination_page_numbering', ['route' => Route::currentRouteName(), 'items' => $items, 'total' => $total])
          
          <table id="my-table" {{-- id="datatable" --}} class="table table-bordered table-hover rounded display">


            <thead>
              <th style="width: 10px;">{{ __('backend/default.sl') }}</th>
              <th>{{ __('backend/default.message') }}</th>
              {{-- <th class="action">{{ __('backend/default.action') }}</th> --}}
            </thead>

            <tbody>
              @foreach($rows as $row)
              <tr class="{{ $row->status == 0 ? 'deactive_':'' }}">
                <td class="text-center">{{ n2l($loop->index + 1) }}</td>
                <td>
                  <p class="mb-0 p-0">
                    <strong>{{ $row->message_subject }}</strong>
                    <br>
                    <sup>
                      <span class="text-secondary">{{ num2locale($row->created_at->diffForHumans()) }}</span> {!! (time()-strtotime($row->updated_at)) < (18*60*60) ? '<i class="new_ text-warning font-weight-bold">[New]</i>':'' !!}
                      {{-- <br>{!! $row->updated_at.'<br>'.$row->created_at. ' '.time() !!} --}}
                    </sup>
                    <br>
                    <span>{!! $row->message_body !!}</span>
                  </p>
                </td>
              </tr>
              @endforeach
            </tbody>

          </table>
        </div>

        <!-- Paginaiton -->
        @include('backend.partials.pagination', ['table' => $rows])
        
      </div>
    </div>
  </div>
</div>
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
@endsection