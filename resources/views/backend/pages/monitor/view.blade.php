@extends('backend.layouts.master')

@section('fav_title', __('backend/monitor.view_monitor') )

@section('styles')
@endsection

@section('content')

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
		<h1><i class="{{ 'fa fa-pie-chart' }}"></i> {{ __('backend/monitor.monitor_management') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.monitor.index') }}">{{ __('backend/monitor.monitor') }}</a></li>
		<li class="breadcrumb-item active">{{ __('backend/default.view') }}</li>
	</ul>
</div>

<!-- Table Part -->
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-header">
				<div class="row">
					<div class="col-md-6 my-auto"><h2><i class="{{ 'fa fa-eye' }}"></i> {{ __('backend/monitor.view_monitor') }}</h2></div>
					<div class="col-md-6 btn-group justify-content-end">

						{{-- SubMenu --}}
			            @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus])
			            
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="card-body">

				<div class="">
					<div class="table-responsive">
						<table class="table table-bordered display table-striped">
							<tbody>
								<tr>
									<td>
										<strong>Title: </strong>
									</td>
									{{-- <td>
										<span class="monospace-inconsolata">{{ $row->title }}</span>
									</td> --}}
								</tr>
								<tr>
									<td>
										<strong>Photo<small><sub>(s)</sub></small>: </strong>
									</td>
									{{-- <td>
										@foreach($row->image as $image)
										<img class="monospace-inconsolata" style="width: 200px;" src="{{ asset($image) }}">
										@endforeach
									</td> --}}
								</tr>
                                <tr>
                                	<td>
                                		<strong>Status: </strong>
                                	</td>
                                	{{-- <td>
                                		<span class="monospace-inconsolata">{{ $row->status == 1 ? 'Active' : 'Inactive' }}</span>
                                	</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
    @section('scripts')
    @endsection