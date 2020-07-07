@extends('backend.layouts.master')

@section('fav_title', 'Edit Menu')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-laptop"></i> {{ __('backend/menu.menu_management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-code-fork fa-lg fa-fw"></i> {{ __('backend/all.developer') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">{{ __('backend/menu.menu') }}</a></li>
    <li class="breadcrumb-item active">{{ __('backend/default.edit') }}</li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="fa fa-pencil-square"></i> {{ __('backend/menu.edit_menu') }}</h2></div>
          <div class="col-md-6 btn-group justify-content-end">
            <a href="{{ route('admin.menu.index') }}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="{{ __('backend/menu.menu_list') }}"><i class="fa fa-list-ul"></i></a>
            <a href="{{ route('admin.menu.create') }}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="{{ __('backend/default.add_new') }}"><i class="fa fa-plus"></i></a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="card-body">
        @include('backend.partials.error_message')
        <form action="{{ route('admin.menu.update', $singleMenu->id) }}" method="post">
          @csrf
          <div class="form-row">
            <div class="col-md-6 form-group">
              <label for="menu">Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="menu" id="menu" placeholder="menu name" value="{{ $singleMenu->menu }}" required>
            </div>

            <div class="col-md-6 form-group">
              <label for="menu_bn">Name (Bn) <span class="text-danger">*</span></label>
              <input type="text" class="form-control avro_bn" name="menu_bn" id="menu_bn" value="{{ $singleMenu->menu_bn }}" placeholder="menu bangla name" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6 form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="icon">Icon <span class="text-danger">*</span></label>
                  {{-- <input type="text" class="form-control" name="icon" id="icon" placeholder="menu icon" value="{{ $singleMenu->icon }}" required> --}}
                  <select name="icon" id="fontawesome_" class="form-control fontawesome_"></select>
                </div>
                <div class="col-md-6">
                  <label for="icon">Icon Color <span class="text-danger">*</span></label>
                  <input type="color" class="form-control" name="icon_color" id="icon_color" placeholder="Menu Icon Color" required value="{{ $singleMenu->icon_color }}">
                </div>
              </div>
            </div>
            <div class="col-md-6 form-group">
              <label for="parent_id">Parent Menu</label>
              <select name="parent_id" id="parent_id" class="form-control">
                <option value="" selected>Select Parent Menu</option>
                @foreach($menus as $menu)
                <option value="{{ $menu->id }}" {{ $menu->id == $singleMenu->parent_id? 'selected' : '' }}>{{ $menu->menu }} 
                  @php
                  $sub = $menu->parent_id;
                  if($sub){
                    $sub_first = $menu->parent;
                    echo ' \ '.$sub_first->menu;
                    $sub_second = $sub_first->parent_id;
                    if($sub_second){
                      echo ' \ '.$sub_first->parent->menu;
                    }
                  }
                  @endphp  
                </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6 form-group">
              <label for="menu_position">Position <span class="text-danger">*</span></label>
              <select name="menu_position" id="menu_position" class="form-control" required>
                <option value="0" {{ $singleMenu->menu_position == 0 ? 'selected' : '' }}>Sidebar</option>
                <option value="1" {{ $singleMenu->menu_position == 1 ? 'selected' : '' }}>In Body</option>
                <option value="2" {{ $singleMenu->menu_position == 2 ? 'selected' : '' }}>Nav Right</option>
                <option value="3" {{ $singleMenu->menu_position == 3 ? 'selected' : '' }}>Nav Right In</option>
                <option value="4" {{ $singleMenu->menu_position == 4 ? 'selected' : '' }}>Nav Left</option>
                <option value="5" {{ $singleMenu->menu_position == 5 ? 'selected' : '' }}>Nav Left In</option>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label for="order">Menu Order <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="order" id="order" value="{{ $singleMenu->order }}" placeholder="menu order" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6 form-group">
              <label for="url">URL </label>
              <input type="text" class="form-control" name="url" id="url" placeholder="menu name" value="{{ $singleMenu->url }}">
            </div>

            <div class="col-md-6 form-group">
              <label for="route">Route </label>
              <input type="text" class="form-control" name="route" id="route" value="{{ $singleMenu->route }}">
            </div>

            <div class="col-md-6 form-group">
              <label for="status">Status </label>
              <select name="status" id="status" class="form-control">
                <option value="1" {{ $singleMenu->status == 0 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $singleMenu->status == 0 ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>
          </div>

          <button type="submit" name="save_menu" class="btn btn-success float-right">{{ __('backend/default.submit') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')

@include('backend.partials.script_edit_fontawesome')

<script>
  $(document).ready(function(){
    $('#parent_id').select2();
  });
  
  $(function(){
    $('input[name=menu_bn]').avro({'bangla':true}, 
      /*function(isBangla){
      alert('Bangla enabled = ' + isBangla);
    }*/
    );
  });
</script>
@endsection
