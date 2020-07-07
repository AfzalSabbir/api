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

<div class="row custom_pagination" id="pagination_container" style="display: none;">
  @if ($total>0)
  <div class="col-sm-12 col-md-6 pull-right">
    <label class="py-2 m-0" style="float: left;">{{ __('backend/default.Showing_pagination_count', ['from' => num2locale($PreviousPageLastSN+1), 'to' => num2locale(($PreviousPageLastSN+$items) >= $total ? $total : $PreviousPageLastSN+$items), 'of' => num2locale($total)]) }}</label>

  </div>
  @else
  <div class="col-sm-12 col-md-12 pull-right" >
    <h3 class="alert alert-warning text-center" style="float: left; color: red; width: 100%;">{{ __('backend/default.no_data') }}</h3>
  </div>
  @endif

  <div class="col-sm-12 col-md-6 pull-left">
    @if(isset($where))
      <label style="float: right">{{ $table->appends(\Request::query())->render() }}</label>
    @else
       <label style="float: right">{{ $table->appends(['items' => $items])->links() }}</label>
    @endif
    
  </div>
</div>


{{--
  --
  -- Call by >>>
  -- @include('frontend.partials.pagination', ['table' => $rows])
  -- `$rows` will be received as `$table`
  --
--}}
