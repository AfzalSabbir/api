@extends('backend.layouts.master')

@section('fav_title', 'Database Backup')

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
    <h1><i class="fa fa-database"></i> {{ __('backend/default.backup_management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg fa-fw"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
    <li class="breadcrumb-item active">{{ __('backend/default.backup') }}</li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="fa fa-table"></i> {{ __('backend/default.backup') }}</h2></div>
          <div class="col-md-6">
            @foreach($thisSubMenus as $thisSubMenu)
              @if($thisSubMenu['menu'] != "Action" && in_array($thisSubMenu['id'], $mySubMenus))
                <a href="{{ route($thisSubMenu['route']) }}" class="btn btn-primary float-right" data-toggle="tooltip" data-html="true" title="{{ Config::get('app.locale') == 'en' ? $thisSubMenu['menu']:$thisSubMenu['menu_bn'] }}"><i class="{{ $thisSubMenu['icon'] }}"></i></a>
              @endif
            @endforeach
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="datatable" class="table table-bordered table-striped display rounded">
            <thead>
              <th width="7%" class="text-center">{{ __('backend/default.sl') }}</th>
              <th>{{ __('backend/default.created') }}</th>
              <th>{{ __('backend/default.file') }}</th>
              <th>{{ __('backend/default.size') }}</th>
              <th class="action text-center" width="20%">{{ __('backend/default.action') }}</th>
            </thead>

            <tbody>
              @php
                $i = 1;
              @endphp
              @foreach($dircontents as $file)
                @php
                  $this_file_size = filesize('database/'.env('DUMP_PATH_NAME').'/'.$file);
                  $this_file_size= $this_file_size/1024 > 1023 ? number_format((float)(($this_file_size/1024)/1024), 2, '.', '') . ' MB':number_format((float)($this_file_size/1024), 2, '.', '') . ' KB';
                  $extension = pathinfo($file, PATHINFO_EXTENSION);
                @endphp
                @if($extension == 'zip')
                  <tr>
                    <td class="text-center">{{ num2locale($i++) }}</td>
                    <td>
                      @php
                        $fileName = pathinfo($file)['filename'];
                        $fileName = substr($fileName, 0, 10).' '.str_replace('-', ':', substr($fileName, 11));
                        echo num2locale(\Carbon\Carbon::createFromTimeStamp(strtotime($fileName))->diffForHumans());
                      @endphp
                    </td>
                    <td>{{ num2locale($file) }}</td>
                    <td>{{ num2locale($this_file_size) }}</td>
                    <td class="text-center action">
                      <div class="btn-group">
                        @foreach($permissions->submenus as $key => $permission)
                          @if(\App\Models\Menu::checkBodyMenu($permission->id, $myRole->in_body))
                            @if($key == 0)
                              <a title="Click to download!" href="{{ asset('database/'.env('DUMP_PATH_NAME').'/'.$file) }}" download class="btn btn-info db-download"><i class="fa fa-download"></i></a>
                            @elseif($key == 1)
                            <form method="post" class="d-inline" action="{{ route('admin.backup.restore') }}">
                              @csrf
                              <input type="hidden" name="zip_name" value="{{ $file }}">
                              <button title="Click to restore!" href="" class="rounded-0 btn btn-warning db-download"><i class="fa fa-upload"></i></button>
                            </form>
                            @else
                              <button title="Delete" onClick="deleteMethod({{ json_encode($file) }})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            @endif
                          @endif
                        @endforeach
                      </div>
                    </td>
                  </tr>
                @endif
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
<script type="text/javascript">
  $(document).ready(function() {
    $('.db-download').on('click', function() {
      $(this).addClass('btn-success');
      $(this).removeClass('btn-info');
    });
  });
</script>
@endsection
