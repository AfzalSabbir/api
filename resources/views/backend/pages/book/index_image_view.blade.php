<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/book.book') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
<style type="text/css">
	a.disabled:hover {
		cursor:not-allowed
	}
	.ellipsis {
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>
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
		<h1><i class="{{ 'fa fa-book' }}"></i> {{ __('backend/book.book_management') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
		<li class="breadcrumb-item active">{{ __('backend/book.book') }}</li>
	</ul>
</div>

<!-- Table Part -->
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-header">
				<div class="row">
					<div class="col-md-6"><h2><i class="{{ 'fa fa-table' }}"></i> {{ __('backend/book.all_book') }}</h2></div>
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

				<div class="form-row">
					@foreach($rows as $row)
						<div class="col-md-2 col-6 position-relative hover_me">
							<div class="card-body px-0 py-2" onclick="book_view('{{ route('admin.book.view', encrypt($row->id)) }}')" style="cursor: pointer">
								<img style="border-radius: 2px;" src="{{ asset($row->photo) }}" class="w-100">
								<p style="" class="mb-0 ellipsis pt-1">
									<span>{{ $row->title }}</span>
									<br>
									<strong>Cost</strong>: <span>{{ $row->cost > 0 ? $row->cost.' TK':'Free'}}</span>
								</p>
							</div>
							@if($row->admin_id != \Auth::guard('admin')->user()->id)
							<button class="ask_btn ask_btn_d_none position-absolute py-0 r-0 w-100 btn bt-sm btn-primary text-white" style="z-index: 1; bottom: -15px !important;" onclick="location.href='{{ route('admin.book.accept', encrypt($row->id)) }}'">Ask</button>
							@endif
						</div>
					@endforeach
				</div>
				
				{{-- sending `$rows` and it'll be received by `$table` --}}

				<!--Remove from Comment {{--...--}} for Pagination -->
				
				<!-- Paginaiton -->
				@include('backend.partials.pagination', ['table' => $rows])
				
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
<script type="text/javascript">
		function book_view($loc){
			location.href=$loc;
			console.log($loc);
			// alert($(this).data('href'))
		};
	$(document).ready(function() {
		if ($(window).width() >= 768) {
			$('.ask_btn').hide();
			$('.hover_me').mouseenter(function() {
				$(this).find('.ask_btn').show();
				$(this).css({
					'background': 'var(--nav-light-25)',
					'border-radius': '4px'
				});

				$(this).mouseleave(function(event) {
					$(this).find('.ask_btn').hide();
					$(this).css({
						'background': '',
						'border-radius': ''
					});
				});
			});
		} else {
			// alert($('.hover_me').find('.ask_btn').attr('style'));
			$('.hover_me').addClass('mb-4');
			$('.hover_me').css({
				'background': 'var(--nav-light-25)',
				'border-radius': '4px'
			});
			$('.hover_me').find('.ask_btn').css({
				'display': 'inline !important;'
			});
		}
		$('.ask_btn').removeClass('ask_btn_d_none');
	});
</script>
@endsection