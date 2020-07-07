<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/example.add_example') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
<!-- Top Management Part -->
<div class="app-title">
	<div>
		<h1><i class="{{ 'fa fa-dot-circle-o' }}"></i> {{ __('backend/example.example_management') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.example.index') }}">{{ __('backend/example.example') }}</a></li>
		<li class="breadcrumb-item active">{{ __('backend/default.add_new') }}</li>
	</ul>
</div>

<!-- Add Form Part -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6"><h2><i class="{{ 'fa fa-plus-square' }}"></i> {{ __('backend/example.add_example') }}</h2></div>
					{{-- <div class="col-md-6"><a href="{{ route('admin.example.index') }}" class="float-right btn btn-primary"><i class="fa fa-arrow-left"></i> {{ __('backend/default.list') }}</a></div> --}}
					<div class="clearfix"></div>

				</div>
			</div>
			<div class="card-body">
				@include('backend.partials.error_message')
				<form class="form-horizontal" action="{{-- route('admin.example.store') --}}" method="post" enctype="multipart/form-data">
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
	                            <textarea style="height: 111px;" class="form-control" name="address" id="address" readonly></textarea>
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
@endsection