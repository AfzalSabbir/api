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
					<div class="col-md-6"><h2><i class="{{ 'fa fa-table' }}"></i> {{ __('backend/book.book_list') }}</h2></div>
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
					<a href="#" class="toggle-vis" data-column="1"><b>{{ __('backend/default.title') }}</b></a> |
					<a href="#" class="toggle-vis" data-column="2"><b>{{ __('backend/default.writer') }}</b></a> |
					<a href="#" class="toggle-vis" data-column="3"><b>{{ __('backend/default.cost') }}</b></a> |
					<a href="#" class="toggle-vis" data-column="4"><b>{{ __('backend/default.address') }}</b></a> |

					<a href="#" class="toggle-vis hide-on-load" data-column="5"><b>{{ __('backend/default.post') }}</b></a> |
					{{-- <a href="#" class="toggle-vis hide-on-load" data-column="6"><b>{{ __('backend/default.status') }}</b></a> | --}}
					<a href="#" class="toggle-vis" data-column="6"><b>{{ __('backend/default.action') }}</b></a>

				</div>
				<div class="table-responsive pt-1">
					<!--Remove from Comment {{--...--}} for Pagination -->
					 
					<!-- Search and Select -->
					@include('backend.partials.pagination_page_numbering', ['route' => Route::currentRouteName(), 'items' => $items, 'total' => $total])
					
					<table id="my-table" {{-- id="datatable" --}} class="table table-bordered table-hover rounded display">

						<thead>
							<th class="ellipsis text-center">{{ __('backend/default.sl') }}</th>
							<th class="ellipsis" style="min-width: 150px">{{ __('backend/default.title') }}</th>
							<th class="ellipsis">{{ __('backend/default.writer') }}</th>
							<th class="ellipsis text-center">{{ __('backend/default.cost') }}</th>
							<th class="ellipsis">{{ __('backend/default.address') }}</th>
							<th>{{ __('backend/default.post') }}</th>
							{{-- <th>{{ __('backend/default.status') }}</th> --}}
							<th class="action text-center">{{ __('backend/default.action') }}</th>
						</thead>
						<tbody>
							@foreach ($rows as $row)
							<tr class="{{ $row->status == 0 ? 'inactive_':'' }}">
								<td class="px-1 py-2 text-center">{{ num2locale($loop->index+1) }}</td>
								<td class="px-1 py-2 ellipsis" style="max-width: 150px">{{ $row->title }}<span class="px-1 py-2 d-none">[{{ $row->admin->name }}]</span></td>
								<td class="px-1 py-2 ellipsis" style="max-width: 150px">{{ $row->writer }}</td>
								<td class="px-1 py-2 ellipsis text-center">{{ (int)$row->cost > 0 ? $row->cost:'Free' }}</td>
								<td class="px-1 py-2 ellipsis" style="max-width: 150px">
									{{ $row->district['name'] }},
									{{ $row->upazila['name'] }},
									{{ $row->location }}
								</td>
								<td>{{ $row->admin->name }}</td>
								{{-- <td>{{ $row->status == 1 ? 'Actived' : 'Deactived' }}</td> --}}
								<td class="px-1 py-0 action">
									<div class="btn-group">

										<!-- Checking Admin Access -->
										@foreach($permissions->submenus as $key => $permission)
										@if(\App\Models\Menu::checkBodyMenu($permission->id, $myRole->in_body))

                                        @if($key == 0)
                                        <a href="{{route($permission->route, encrypt($row->id))}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                       	<button
                                       		class="btn {{ $row->admin_id != Auth::guard('admin')->user()->id ? ($row->taken_by_id > 0 ? 'btn-success disabled':'btn-success'):'btn-secondary disabled' }}"
											@if(!($row->taken_by_id > 0))
                                       			onClick="acceptMethod({{ json_encode(encrypt($row->id)) }})"
                                       		@endif
                                       		role="button" {{ $row->admin_id == Auth::guard('admin')->user()->id ? 'disabled':'' }}>
                                       		<i class="fa fa-check"></i>
                                       	</button>
                                        @elseif($key == 1)
                                        <button class="{{ $row->admin_id == Auth::guard('admin')->user()->id ? 'btn btn-warning':'btn btn-secondary disabled' }}" {{ $row->admin_id != Auth::guard('admin')->user()->id ? 'disabled href=# data-toggle=modal data-target=#notAvailable':'onclick=location.href=\''.route($permission->route, encrypt($row->id)).'\'' }}><i class="fa fa-edit"></i></button>
                                        @else
                                        <button class="btn {{ $row->admin_id != Auth::guard('admin')->user()->id ? 'btn-secondary disabled':' btn-danger' }}" onClick="deleteMethod({{ json_encode(encrypt($row->id)) }})" role="button" {{ $row->admin_id != Auth::guard('admin')->user()->id ? 'disabled':'' }}><i class="fa fa-trash"></i></button>
                                        @endif

										@endif
										@endforeach
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
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
@endsection