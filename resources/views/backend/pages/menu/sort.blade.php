@extends('backend.layouts.master')

@section('fav_title', __('backend/menu.menu_sort'))

@section('styles')
  <style type="text/css">
    table .form-control,
    table .form-control:active,
    table .form-control:hover,
    table .form-control:focus {
      border: none !important;
    }
    tbody.listitems td:last-child {
      padding: 0 !important;
    }
    table {
      border-collapse: inherit;
    }
    .changed {
      background: var(--nav-light-25);
      transition: background-color 0.5s ease;
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
    <li class="breadcrumb-item"><a href="{{ route('admin.menu.index') }}">{{ __('backend/menu.menu') }}</a></li>
    <li class="breadcrumb-item active">{{ __('backend/default.edit') }}</li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="fa fa-table"></i> {{ __('backend/menu.menu_sort') }}</h2></div>
          <div class="col-md-6 text-right">
            <div class="btn-group">
              <a href="{{ route('admin.menu.index') }}" class="float-right btn btn-primary" data-toggle="tooltip" data-html="true" title="{{ __('backend/menu.menu_list') }}"><i class="fa fa-list-ul"></i></a>
              <a href="{{ route('admin.menu.create') }}" class="float-right btn btn-primary" data-toggle="tooltip" data-html="true" title="{{ __('backend/default.add_new') }}"><i class="fa fa-plus"></i></a>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="card-body">
        @include('backend.partials.error_message')
        <form action="{{ route('admin.menu.sort_update') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-7 mx-auto">
                <table class="table table-bordered br-4">
                  <thead>
                    <tr class="alert-secondary">
                      <th for="SL" class="">SL</th>
                      <th for="menu" class="w-75">Name </th>
                      <th for="order" class="">Order </th>
                    </tr>
                  </thead>
                  <tbody class="listitems autosort">
                    @foreach($menus as $menu)
                    <tr class="{{ $menu->status == 0 ? 'text-secondary':'font-weight-bold' }}" data-position="{{ $menu->order }}">
                      <td class="cursor-default" id="index"></td>
                      <td class="cursor-default position-relative">{{ $menu->menu }}<i class="fa fa-arrow-up sort-up position-absolute r-1 t-2 text-secondary cursor-pointer"></i><i class="fa fa-arrow-down sort-down position-absolute r-1 b-2 text-secondary cursor-pointer"></i></td>
                      <td style="background-image: linear-gradient(#eee, #fff, #fff, #eee);">
                        <input type="hidden" class="form-control avro_bn" name="id[]" id="id" value="{{ $menu->id }}" required>
                        <input type="text" class="form-control avro_bn" name="order[]" id="order" value="{{ $menu->order }}" required style="background: transparent;">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <button type="submit" name="save_menu" class="btn btn-success float-right">{{ __('backend/default.submit') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function(){
    $('#parent_id').select2();
    $(".listitems").each(function(){
      $(this).html($(this).children('tr').sort(function(a, b){
        return ($(b).data('position')) < ($(a).data('position')) ? 1 : -1;
      }));
    });
    var ind = 0;
    $('tbody #index').each(function() {
      ind = ind +1;
      $(this).prepend("<span>" + ind + "</span>");
    });
  });
  
  $(function(){
    $('input[name=menu_bn]').avro({'bangla':true}, 
      /*function(isBangla){
      alert('Bangla enabled = ' + isBangla);
    }*/
    );
  });
</script>
<script>
  $(document).ready(function() {
    $('.sort-down').mouseover(function(event) {
      $(this).removeClass('text-secondary').addClass('text-default');
      $(this).mouseleave(function(event) {
        $(this).removeClass('text-default').addClass('text-secondary');
      });
    });
    $('.sort-up').mouseover(function(event) {
      $(this).removeClass('text-secondary').addClass('text-default');
      $(this).mouseleave(function(event) {
        $(this).removeClass('text-default').addClass('text-secondary');
      });
    });
    $(".sort-up, .sort-down").click(function(){
      var row = $(this).parents("tr:first");
      $(this).closest('tr').addClass('changed');
      var find_ = $(this).closest('table').find('.changed');

      setTimeout(function(){
        find_.removeClass('changed');
      }, 700);

      if ($(this).is(".sort-up")) {
          var thisSortValOriginal     = $(this).closest('tr').find('input:last-child');
          thisSortVal                 = thisSortValOriginal.val();

          var previousSortValOriginal = $(this).closest('tr').prev('tr').find('input:last-child');
          previousSortVal             = previousSortValOriginal.val();

          if (previousSortVal > 0) {
            thisSortValOriginal.val(previousSortVal);
            previousSortValOriginal.val(thisSortVal);
            row.insertBefore(row.prev());
          }

      } else {
          var thisSortValOriginal     = $(this).closest('tr').find('input:last-child');
          thisSortVal                 = thisSortValOriginal.val();

          var nextSortValOriginal     = $(this).closest('tr').next('tr').find('input:last-child');
          nextSortVal                 = nextSortValOriginal.val();

          if (nextSortVal > 0) {
            thisSortValOriginal.val(nextSortVal);
            nextSortValOriginal.val(thisSortVal);
            row.insertAfter(row.next());
          }

      }
    });
  });
</script>
@endsection
