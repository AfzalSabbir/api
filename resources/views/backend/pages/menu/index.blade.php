@extends('backend.layouts.master')

@section('fav_title', 'Menu')

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
<div class="app-title">
  <div>
    <h1><i class="fa fa-laptop"></i> {{ __('backend/menu.menu_management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-code-fork fa-lg fa-fw"></i> {{ __('backend/all.developer') }}</li>
    <li class="breadcrumb-item active">{{ __('backend/menu.menu') }}</li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="fa fa-table"></i> {{ __('backend/menu.menu_list') }}</h2></div>
          <div class="col-md-6 text-right">
            <div class="btn-group">
              <a href="{{ route('admin.role.assign.super_admin') }}" style="color: white;" class="btn btn-primary Menu_Permission border-0" data-toggle="tooltip" data-html="true" title="Super Admin Permission"><i class="fa fa-cogs"></i>/ <i class="fa fa-gavel"></i>/ <i class="fa fa-pencil"></i></a>
              <a href="{{ route('admin.menu.create') }}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="{{ __('backend/default.add_new') }}"><i class="fa fa-plus"></i></a>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="card-body">
        <div class="toggle-table-column alert-info br-2 p-2 mb-2">
          <strong>{{ __('backend/default.table_toggle_message') }} </strong>
          <a href="#" class="toggle-vis" data-column="0"><b>SL</b></a> | 
          <a href="#" class="toggle-vis" data-column="1"><b>Menu(En)</b></a> | 
          <a href="#" class="toggle-vis hide-on-load" data-column="2"><b>Menu(Bn)</b></a> | 
          <a href="#" class="toggle-vis" data-column="3"><b>Parent</b></a> | 
          <a href="#" class="toggle-vis" data-column="4"><b>Position</b></a> | 
          <a href="#" class="toggle-vis" data-column="5"><b>Icon</b></a> | 
          <a href="#" class="toggle-vis hide-on-load" data-column="6"><b>URL</b></a> |
          <a href="#" class="toggle-vis" data-column="7"><b>Route</b></a> |
          <a href="#" class="toggle-vis hide-on-load" data-column="8"><b>Status</b></a> |
          <a href="#" class="toggle-vis" data-column="9"><b>Action</b></a>
        </div>
        <div class="table-responsive">
          <table id="datatable" class="table table-bordered table-hover rounded display">
            <thead>
              <th width="3%">SL</th>
              <th width="10%">Menu(En)</th>
              <th width="10%">Menu(Bn)</th>
              <th width="10%">Parent</th>
              <th width="10%">Position</th>
              <th width="3%">Icon</th>
              <th width="5%">URL</th>
              <th width="5%">Route</th>
              <th width="4%">Status</th>
              <th width="8%" class="action">Action</th>
            </thead>

            <tbody>
              @foreach($menus as $menu)
              <tr class="{{ $menu->status == 0 ? 'inactive_':'' }}">
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $menu->menu }}</td>
                <td>{{ $menu->menu_bn }}</td>
                <td>{{ $menu->parent_id ? $menu->parent->menu : 'N/A' }}</td>
                <td>
                  @php
                    switch ($menu->menu_position) {
                      case '0':
                        $position = 'Sidebar';
                        break;
                      case '1':
                        $position = 'In Body';
                        break;
                      case '2':
                        $position = 'Nav Right';
                        break;
                      case '3':
                        $position = 'Nav Right In';
                        break;
                      case '4':
                        $position = 'Nav Left';
                        break;
                      case '5':
                        $position = 'Nav Left In';
                        break;
                    }
                    echo $position;
                  @endphp
                </td>
                <td style="background-color: #ddd; text-align: center;"><h4><i class="{{ $menu->icon }}" style="color: {{ $menu->icon_color }};"></i></h4></td>
                <td>{{ $menu->url }}</td>
                <td>{{ $menu->route }}</td>
                <td>{{ $menu->status == 1 ? 'Active' : 'Inactive' }}</td>
                <td class="action">
                  <div class="btn-group">
                    <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger" onClick="deleteMethod({{ $menu->id }})" role="button"><i class="fa fa-trash"></i></button>
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
