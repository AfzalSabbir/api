@extends('backend.layouts.master')

@section('fav_title', 'Add Menu')


@section('styles')
<style>
  kbd {
    padding: 0 2px;
  }
</style>
@endsection

@section('content')
<div class="app-title">
  <div>
    <h1 class="shortKey_container"><i class="fa fa-laptop"></i> {{ __('backend/menu.menu_management') }} <code class="shortKey_" style="display: none;"><sup>[<small><kbd>ctrl</kbd>+<kbd>alt</kbd>+<kbd>Shift</kbd>+<kbd>n</kbd></small>]</sup></code></h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-code-fork fa-lg fa-fw"></i> {{ __('backend/all.developer') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">{{ __('backend/menu.menu') }}</a></li>
    <li class="breadcrumb-item active">{{ __('backend/default.add_new') }}</li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="fa fa-plus-square"></i> {{ __('backend/menu.add_menu') }}</h2></div>
          <div class="col-md-6"><a href="{{ route('admin.menu.index') }}" class="float-right btn btn-primary" data-toggle="tooltip" data-html="true" title="{{ __('backend/menu.menu_list') }}"><i class="fa fa-list-ul"></i></a></div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="card-body">
        @include('backend.partials.error_message')
        <form id="myform" action="{{ route('admin.menu.store') }}" method="post">
          @csrf
          <div class="form-row">
            <div class="col-md-6 form-group">
              <label for="menu">Name (En) <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="menu" id="menu" required placeholder="Menu English Name">
            </div>

            <div class="col-md-6 form-group">
              <label for="menu_bn">Name (Bn) <span class="text-danger">*</span></label>
              <input type="text" class="form-control avro_bn" name="menu_bn" id="menu_bn" required placeholder="Menu Bangla Name">
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6 form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="icon">Icon <span class="text-danger">*</span></label>
                  {{-- <input type="text" class="form-control" name="icon" id="icon" placeholder="menu icon" required> --}}
                  <select name="icon" id="fontawesome_" class="form-control fontawesome_"></select>
                </div>
                <div class="col-md-6">
                  <label for="icon">Icon Color <span class="text-danger">*</span></label>
                  <input type="color" class="form-control" name="icon_color" id="icon_color" placeholder="Menu Icon Color" required value="#ffffff">
                </div>
              </div>
            </div>

            <div class="col-md-6 form-group">
              <label for="parent_id">Parent Menu</label>
              <select name="parent_id" id="parent_id" class="form-control">
                <option value="" selected disabled>Select Parent Menu</option>
                @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->menu }} 
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
                <option value="" disabled selected>Select Position</option>
                <option value="0">Sidebar</option>
                <option value="1">In Body</option>
                <option value="2">Nav Right</option>
                <option value="3">Nav Right In</option>
                <option value="4">Nav Left</option>
                <option value="5">Nav Left In</option>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label for="order">Menu Order <span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="order" id="order" placeholder="Menu Order" required>
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6 form-group">
              <label for="url">URL </label>
              <input type="text" class="form-control" name="url" id="url" placeholder="Menu Name">
            </div>

            <div class="col-md-6 form-group">
              <label for="route">Route </label>
              <input type="text" class="form-control" name="route" id="route" placeholder="menu route">
            </div>
          </div>

          {{-- <div class="form-row">
            <div class="col-md-6 form-group">
              <label for="status">Status </label>
              <select name="status" id="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div> --}}
          <div class="form-row b-1 alert-secondary br-4 pt-3" style="border: 1px solid #ced4da">
            <div class="col-md-6 form-group">
              <label for="status">Menu Sidebar</label>
              <select name="otherMenu1[]" id="otherMenu1" class="form-control" style="max-height: 37px;" multiple>
                <option disabled>&#9673; Select Multiple</option>
                <option value="add">&nbsp;&nbsp;&#9678; Add New</option>
                <option value="list">&nbsp;&nbsp;&#9678; List</option>
                <option value="action">&nbsp;&nbsp;&#9678; Action</option>
              </select>
            </div>
            <div class="col-md-6 form-group">
              <label for="status">Menu In Body</label>
              <select name="otherMenu2[]" id="otherMenu2" class="form-control" style="max-height: 37px;" multiple>
                <option disabled><i class="fa fa-circle-o"></i>&nbsp;&#9678; Select Multiple</option>
                <option value="view">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#9679; View</option>
                <option value="edit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#9679; Edit</option>
                <option value="delete">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#9679; Delete</option>
              </select>
            </div>
            <div class="container-fluid">
              <div class="row px-2">
                <div class="col-md-9 form-group px-0">
                  <code>Action &gt;&gt; (View &gt; Edit &gt; Delete)</code><br><code>List &gt;&gt; (View &gt; Edit &gt; Delete)</code>
                </div>
                <div class="col-md-3 form-group px-0">
                  <button type="submit" name="save_menu" class="btn btn-success float-right">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')

  @include('backend.partials.script_add_fontawesome')

  <script type="text/javascript" charset="utf-8">
    $(function(){
      $('input[name=menu_bn]').avro();
    });
  </script>
  <script type="text/javascript" charset="utf-8">
    $(function(){
      $('input[name=menu_bn]').avro({'bangla':true});
    });
  </script>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      
      $('#status').select2();
      $('#parent_id').select2();
      $('#otherMenu1').select2();
      $('#otherMenu2').select2();
      $('#menu_position').select2();

      $("#otherMenu2").prop("disabled", true);
      $("#otherMenu1").on('select2:close', function () {
        if ($("#otherMenu1").val() == 'add' || $("#otherMenu1").val() == '') {
          $("#otherMenu2").prop("disabled", true);

        } else {
          $("#otherMenu2").prop("disabled", false);
        }
      });

      $('#menu').blur(function() {
        $('.change_me').text($(this).val());
      });

      $('#url').blur(function() {
        var str = $(this).val();
        if (str[0] == '/' || str == '') {
          str = str.substring(1, str.length);
        } else {
          $(this).val('/' + str);
        }
        if (str[str.length-1] == '/') {
          str = str.substring(0, str.length-1);
        }
        str = str.replace(/\//g, '.');
        if ((str.match(/\./g)||[]).length == 1) {
          str = str + '.index'
        }
        $('#route').val(str);
      });

      $('#myform').validate({
        messages: {
          menu: "{{ __('default.required_validation') }}",
          menu_bn: "{{ __('default.required_validation') }}",
          icon: "{{ __('default.required_validation') }}",
          order: "{{ __('default.required_validation') }}",
        } 
      });
    });
  </script>
@endsection
