<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/#fileDirectory#.#fileName#_#fileDirectory#') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
<!-- Top Management Part -->

<!--Remove from Comment {{--...--}} for Permission -->
{{-- Permission for Admin Access --}}


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
		<h1><i class="{{ '#fafaOfSideMenu#' }}"></i> {{ __('#langFolderDirectory#/#fileDirectory#.#tagManagement#') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('#dashboardRoute#') }}">{{ __('#langFolderDirectory#/default.dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('#indexFileRoute#') }}">{{ __('#langFolderDirectory#/#fileDirectory#.#fileDirectory#') }}</a></li>
		<li class="breadcrumb-item active">{{ __('#langFolderDirectory#/default.add_new') }}</li>
	</ul>
</div>

<!-- Add Form Part -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6 my-auto"><h2><i class="{{ '#fafaCardHeader#' }}"></i> {{ __('#langFolderDirectory#/#fileDirectory#.add_#fileDirectory#') }}</h2></div>
					<div class="col-md-6 btn-group justify-content-end">

						{{-- SubMenu --}}
			            @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus])
			            
					</div>
					<div class="clearfix"></div>

				</div>
			</div>
			<div class="card-body">
				@include('backend.partials.error_message')
				<form class="form-horizontal" action="{{-- route('admin.#fileDirectory#.store') --}}" method="post" enctype="multipart/form-data">
					@csrf

	                <div class="form-row">
	                    <div class="col-md-6">
	                        <label for="title" class="label">Title</label>
	                        <div>
	                            <input type="text" class="form-control mb-2" name="title" id="title" readonly>
	                        </div>
	                        <label for="name" class="label">Photo</label>
	                        <div class="custom-file">
								<input type="file" class="custom-file-input" @click.prevent id="validatedCustomFile">
								<label class="custom-file-label alert-secondary" for="validatedCustomFile" @click.prevent >Choose file...</label>
							</div>
	                    </div>
	                    <div class="col-md-6 mb-2">
	                        <label for="address" class="label">Address</label>
	                        <div>
	                            <textarea style="height: 114px;" class="form-control" name="address" id="address" readonly></textarea>
	                        </div>
	                    </div>
	                </div>

					<button type="submit" class="btn btn-primary float-right">{{ __('#langFolderDirectory#/default.submit') }}</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
@endsection