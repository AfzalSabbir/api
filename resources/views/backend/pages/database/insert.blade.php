<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/database.Insert_database') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
	<link href="{{ asset('public/plugins/Text-Editor-With-Line-Numbers-jQuery-LinedTextDiv/linedTextEditor-jquery.css') }}" rel="stylesheet">
	<style type="text/css">
		.linesContainer .line-number:nth-child(2n) {
			background: #212529;
		}
		kbd {
			font-size: 100%;
			border-radius: 0 0.2rem 0.2rem 0;
		}
		lines {
			line-height: 21px !important;
    		font-size: 16px !important;
		}
	</style>
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
<!-- Top Management Part -->
<div class="app-title">
	<div>
		<h1><i class="{{ 'fa fa-database' }}"></i> {{ __('backend/database.database_management') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.database.insert') }}">{{ __('backend/database.database') }}</a></li>
		<li class="breadcrumb-item active">{{ __('backend/default.add_new') }}</li>
	</ul>
</div>

<!-- Add Form Part -->
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6"><h2><i class="{{ 'fa fa-plus-square' }}"></i> {{ __('backend/database.add_database') }} SQL</h2></div>
					<div class="col-md-6">
						<a href="#file" class="float-right btn btn-primary" id="insert_file"><i class="fa fa-sign-in"></i> {{ __('backend/default.insert_file') }}</a>
					</div>
					<div class="clearfix"></div>

				</div>
			</div>

			<div class="card-body">
				<form id="form_container" class="alert-secondary p-3 mb-3 br-2" style="display: none;">
					@csrf
					{{-- <label class="mb-0">Select File </label> --}}
					<input id="sql_text" name="sql_text" type="file" />
					<i id="sql_text_spinner" class="fa fa-spinner fa-pulse fa-2x float-right text-info" aria-hidden="true" style="display: none;"></i>
				</form>

				@include('backend.partials.error_message')
				<form class="form-horizontal" action="{{ route('admin.database.insert') }}" method="post" enctype="multipart/form-data">
					@csrf
					<textarea name="insert" class="insert" id="insert" style="display:none;">
					</textarea>
					<kbd class="lined" style="color: aquamarine"></kbd>

					<button type="submit" class="btn btn-primary float-right">{{ __('backend/default.insert') }}</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
	{{-- <script src="//code.jquery.com/jquery.min.js"></script> --}}
	<script src="{{ asset('public/plugins/Text-Editor-With-Line-Numbers-jQuery-LinedTextDiv/linedTextEditor-jquery.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".lined").linedTextEditor();
			$(".lined").blur(function(event) {
				$("#insert").text($(this).text());
			});
			$('.lined').on("copy cut", function (e) {
				e.preventDefault();
			});
		});
	</script>
	<script>
		$("#insert_file").on('click', function(){
			$("#form_container").show();
		});

		// $("form").submit(function(evt){	 
		$("#sql_text").on('change', function(evt){
			$("#sql_text_spinner").show();
			evt.preventDefault();
			var formData = new FormData($("#form_container")[0]);
			$.ajax({
				url: '{{ route("admin.database.get_file_text") }}',
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				enctype: 'multipart/form-data',
				processData: false,
				success: function (response) {
					$("#insert").text(response);
					$(".lined-textarea").text(response);
					$("#sql_text_spinner").hide();
				}
			});
			return false;
		});
	</script>
@endsection