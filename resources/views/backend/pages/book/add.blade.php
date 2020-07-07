<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/book.add_book') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
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
		<li class="breadcrumb-item"><a href="{{ route('admin.book.index') }}">{{ __('backend/book.book') }}</a></li>
		<li class="breadcrumb-item active">{{ __('backend/default.add_new') }}</li>
	</ul>
</div>

<!-- Add Form Part -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6"><h2><i class="{{ 'fa fa-plus-square' }}"></i> {{ __('backend/book.add_book') }}</h2></div>
					<div class="col-md-6 btn-group justify-content-end">

						{{-- SubMenu --}}
			            @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus])
			            
					</div>
					<div class="clearfix"></div>

				</div>
			</div>
			<div class="card-body">
				@include('backend.partials.error_message')
				<form class="form-horizontal" action="{{ route('admin.book.store') }}" method="post" enctype="multipart/form-data">
					@csrf

	                <div class="form-row">
	                    <div class="col-md-6">
	                        <label for="title" class="label mb-1">{{ __('backend/default.title') }}</label>
	                        <div>
								<input type="text" class="form-control mb-2" value="{{ old('title') }}" name="title" id="title" required>
	                        </div>

	                        <label for="writer" class="label mb-1">{{ __('backend/default.writer') }} <code>[Use <strong>semicolon</strong> for multiple writer]</code></label>
	                        <div>
	                            <input type="text" class="form-control mb-2" value="{{ old('writer') }}" name="writer" id="writer">
	                        </div>

							<div class="form-row">
	                    		<div class="col-md-6">
			                        <label for="edition" class="label mb-1">{{ __('backend/default.edition') }}</label>
			                        <div>
			                            <input type="text" class="form-control mb-2" value="{{ old('edition') }}" name="edition" id="edition">
			                        </div>
			                    </div>
	                    		<div class="col-md-6">
			                        <label for="grade_id" class="label mb-1">{{ __('backend/default.grade') }}</label>
			                        <div>
		                                <select value="{{ old('grade_id') }}" name="grade_id" class="form-control mb-2" id="grade_id" required>
		                                    <option disabled="" selected="">-- Select Grade --</option>
		                                    <option value='5'>Higher Education (Hons./MS/PhD)</option>
		                                    <option value='4'>Higher Secondary (11-12)</option>
		                                    <option value='3'>Secondary (9-10)</option>
		                                    <option value='2'>Lower Secondary (6-8)</option>
		                                    <option value='1'>Primary (1-5)</option>
		                                </select>
			                        </div>
			                    </div>
			                </div>

	                        <label for="photo" class="label mb-1">{{ __('backend/default.image') }} <code>[Image dimension: 100x120 (1:1.2). Max size 2MB]</code></label>
	                        <div>
	                            <input onchange="upload_check()" type="file" class="form-control mb-2" name="photo" id="photo" required>
	                        </div>
							<div class="form-row">
	                    		<div class="col-md-6">
			                        <label for="cost" class="label mb-1">{{ __('backend/default.cost') }}</label>
			                        <div>
			                            <input type="number" class="form-control mb-2" value="{{ old('cost') }}" name="cost" id="cost" value="0" required>
			                        </div>
			                    </div>
	                    		<div class="col-md-6">
			                        <label for="contact" class="label mb-1">{{ __('backend/default.contact') }}</label>
			                        <div>
			                            <input type="text" class="form-control mb-2" name="contact" id="contact" value="{{ !empty(old('contact')) ? old('contact') : Auth::guard('admin')->user()->mobile }}" required>
			                        </div>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-md-6 mb-2">
	                        <label for="book_condition" class="label mb-1">{{ __('backend/default.condition') }}</label>
	                        <div class="mb-2">
                                <select value="{{ old('book_condition') }}" name="book_condition" class="form-control mb-2" id="book_condition" required>
                                    <option disabled="" selected="">-- Select Condition --</option>
                                    <option value='3'>New</option>
                                    <option value='2'>Good</option>
                                    <option value='1'>Poor</option>
                                </select>
	                        </div>

	                        <label for="district" class="label mb-1">{{ __('backend/default.district') }}</label>
	                        <div class="mb-2">
                                <select name="district_id" class="form-control mb-2" id="district" required>
                                    <option disabled="" selected="">-- Select District --</option>
                                	@foreach($districts as $district)
                                    	<option value='{{ $district->id }}'>{{ $district->name }}</option>
                                	@endforeach
                                </select>
	                        </div>

	                        <label for="upazila" class="label mb-1">{{ __('backend/default.upazila') }}</label>
	                        <div class="mb-2">
                                <select name="upazila_id" disabled="" class="form-control mb-2" id="upazila" required>
                                    <option disabled="" selected="">-- Select Upazila --</option>
                                	@foreach($upazilas as $upazila)
                                    	<option  class="{{ '_'.$upazila->district_id }}" style="display: none;" value='{{ $upazila->id }}'>{{ $upazila->name }}</option>
                                	@endforeach
                                </select>
	                        </div>

	                        <label for="location" class="label mb-1">{{ __('backend/default.address') }}</label>
	                        <div>
	                            <textarea style="height: 111px;" class="form-control mb-2" name="location" id="location" required></textarea>
	                        </div>
	                    </div>
	                </div>

					<button type="submit" class="btn btn-primary float-right">{{ __('backend/default.submit') }}</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')

	<script type="text/javascript">
		$(document).ready(function(){
			// $('#book_condition').select2();
			// $('#district').select2();
			// $('#upazila').select2();
			var district_id = '';
			$('#district').change(function(event) {

				$('#upazila').removeAttr('disabled');
				district_id = $(this).val();
				$('.'+'_'+district_id).siblings().hide();
				$('.'+'_'+district_id).show();
				console.log(district_id);
			});
		});
	</script>
	<script>
	function upload_check()
	{
		var photo = document.getElementById("photo");
		// alert(photo.files[0].size > 2*1024*1024);
		var max = 2*1024*1024;

		if(photo.files[0].size > max)
		{
		   alert("File too big!");
		   photo.value = "";
		}
	};
	</script>
@endsection