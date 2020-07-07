<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/book.edit_book') )

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
		<h1><i class="{{ 'fa fa-book' }}"></i> {{ __('backend/book.book_management') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.book.index') }}">{{ __('backend/book.book') }}</a></li>
		<li class="breadcrumb-item active">{{ __('backend/default.edit') }}</li>
	</ul>
</div>

<!-- Edit Form Part -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6"><h2><i class="{{ 'fa fa-pencil-square' }}"></i> {{ __('backend/book.edit_book') }}</h2></div>
					<div class="col-md-6 btn-group justify-content-end">

						{{-- SubMenu --}}
			            @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus])
			            
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="card-body">
				@include('backend.partials.error_message')
				<form class="form-horizontal" action="{{ route('admin.book.update', encrypt($row->id)) }}" method="post" enctype="multipart/form-data">
					@csrf


	                <div class="form-row">
	                    <div class="col-md-6">
	                        <label for="title" class="label">Title</label>
	                        <div>
	                            <input value="{{ $row->title }}" type="text" class="form-control mb-2" name="title" id="title">
	                        </div>

	                        <label for="writer" class="label">Writer <code>[Use <strong>semicolon</strong> for multiple writer]</code></label>
	                        <div>
	                            <input value="{{ $row->writer }}" type="text" class="form-control mb-2" name="writer" id="writer">
	                        </div>

							<div class="form-row">
	                    		<div class="col-md-6">
			                        <label for="edition" class="label">Edition</label>
			                        <div>
			                            <input value="{{ $row->edition }}" type="text" class="form-control mb-2" name="edition" id="edition">
			                        </div>
			                    </div>
	                    		<div class="col-md-6">
			                        <label for="grade" class="label">Grade</label>
			                        <div>
		                                <select name="grade" class="form-control mb-2" id="grade">
		                                    <option disabled="">-- Select Grade --</option>
		                                    <option value='5' {{ $row->grade == 5 ? 'selected':'' }}>Higher Education (Hons./MS/PhD)</option>
		                                    <option value='4' {{ $row->grade == 4 ? 'selected':'' }}>Higher Secondary (11-12)</option>
		                                    <option value='3' {{ $row->grade == 3 ? 'selected':'' }}>Secondary (9-10)</option>
		                                    <option value='2' {{ $row->grade == 2 ? 'selected':'' }}>Lower Secondary (6-8)</option>
		                                    <option value='1' {{ $row->grade == 1 ? 'selected':'' }}>Primary (1-5)</option>
		                                </select>
			                        </div>
			                    </div>
			                </div>

	                        <label for="photo" class="label">Image <code>[Photo can't be changed]</code></label>
	                        <div>
	                            <input disabled="" type="file" class="form-control mb-2" {{-- name="photo" id="photo" --}}>
	                        </div>
							<div class="form-row">
	                    		<div class="col-md-6">
			                        <label for="cost" class="label">Cost</label>
			                        <div>
			                            <input value="{{ $row->cost }}" type="number" class="form-control mb-2" name="cost" id="cost">
			                        </div>
			                    </div>
	                    		<div class="col-md-6">
			                        <label for="contact" class="label">Contact</label>
			                        <div>
			                            <input type="text" class="form-control mb-2" name="contact" id="contact" value="{{ $row->contact }}">
			                        </div>
		                        </div>
		                    </div>
	                    </div>
	                    <div class="col-md-6 mb-2">
	                        <label for="book_condition" class="label">Condition</label>
	                        <div class="mb-2">
                                <select name="book_condition" class="form-control mb-2" id="book_condition">
                                    <option disabled="" selected="">-- Select Condition --</option>
                                    <option value='3' {{ $row->book_condition == 3 ? 'selected':'' }}>New</option>
                                    <option value='2' {{ $row->book_condition == 2 ? 'selected':'' }}>Good</option>
                                    <option value='1' {{ $row->book_condition == 1 ? 'selected':'' }}>Poor</option>
                                </select>
	                        </div>

	                        <label for="district" class="label">District</label>
	                        <div class="mb-2">
                                <select name="district_id" class="form-control mb-2" id="district">
                                    <option disabled="">-- Select District --</option>
                                	@foreach($districts as $district)
                                    	<option value='{{ $district->id }}' {{ $row->district_id == $district->id ? 'selected':'' }}>{{ $district->name }}</option>
                                	@endforeach
                                </select>
	                        </div>

	                        <label for="upazila" class="label">Upazila</label>
	                        <div class="mb-2">
                                <select name="upazila_id" class="form-control mb-2" id="upazila">
                                    <option disabled="">-- Select Upazila --</option>
                                	@foreach($upazilas as $upazila)
                                    	<option  class="{{ '_'.$upazila->district_id }}" style="{{ $row->district_id == $upazila->district_id ? '':'display: none;' }}" value='{{ $upazila->id }}' {{ $row->upazila_id == $upazila->id ? 'selected':'' }}>{{ $upazila->name }}</option>
                                	@endforeach
                                </select>
	                        </div>

	                        <label for="location" class="label">Address</label>
	                        <div>
	                            <textarea style="height: 111px;" class="form-control mb-2" name="location" id="location">{!! $row->location !!}</textarea>
	                        </div>
	                    </div>
	                </div>


					<button type="submit" class="btn btn-primary float-right">{{ __('backend/default.update') }}</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
@endsection