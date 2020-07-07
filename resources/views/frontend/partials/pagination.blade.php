@php
  // Pagination Serial
  if (request()->filled('page')){
    $PreviousPageLastSN = $items*(request()->page-1); //PreviousPageLastSerialNumber
    $PageNumber = request()->page;
  }
  else{
    $PreviousPageLastSN = 0; //PreviousPageLastSerialNumber
    $PageNumber = 1;
  }

  //Last Page Items Change Restriction
  if ($PageNumber*$items > $total + $items){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
  }
@endphp

<div class="col-12">
  <div class="row">
    @if ($total>0)
    <div class="col-12 col-lg-6 d-none">
      {{-- <label class="py-2 m-0" style="float: left;">{{ __('backend/default.Showing_pagination_count', ['from' => num2locale($PreviousPageLastSN+1), 'to' => num2locale(($PreviousPageLastSN+$items) >= $total ? $total : $PreviousPageLastSN+$items), 'of' => num2locale($total)]) }}</label> --}}

    </div>
    @else
    <div class="col-12 col-lg-12 d-none" >
      {{-- <h3 class="alert alert-warning text-center" style="float: left; color: red; width: 100%;">{{ __('backend/default.no_data') }}</h3> --}}
    </div>
    @endif

    <div class=" offset-lg-6 col-12 col-lg-6 pt-2 d-none d-lg-block">
      @if(isset($where))
        <label style="float: right">{{ $table->appends(\Request::query())->render() }}</label>
      @else
         <label style="float: right">{{ $table->appends(['items' => $items])->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}</label>
      @endif
      
    </div>
    <div class="col-12 col-lg-6 pt-2 d-block d-lg-none">
      @if(isset($where))
        <label style="float: right">{{ $table->appends(\Request::query())->render() }}</label>
      @else
         <label style="float: right">{{ $table->appends(['items' => $items])->onEachSide(1)->links('vendor.pagination.bootstrap-4-sm') }}</label>
      @endif
      
    </div>
  </div>
</div>


{{--
  --
  -- Call by >>>
  -- @include('frontend.partials.pagination', ['table' => $rows])
  -- `$rows` will be received as `$table`
  --
--}}
