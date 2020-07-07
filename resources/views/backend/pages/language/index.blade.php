@extends('backend.layouts.master')

@section('fav_title', __('backend/default.language') )

@section('styles')
<link href="{!! asset('public/backend/css/material_input.css') !!}" rel="stylesheet" type="text/css" />
<style>
	.action{
		min-width: 70px;
	}
	.table th, .table td{
		vertical-align: middle;
	}
	span,
	.select2-dropdown {
		border-radius: 0 !important;
	}
	li[aria-disabled='true'] {
    	display: none;
    }
</style>
@endsection

@section('content')
<div class="app-title">
	<div>
		<h1><i class="fa fa-globe"></i> {{ __('backend/all.language_management') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="fa fa-code-fork fa-lg"></i> {{ __('backend/all.developer') }}</li>
		<li class="breadcrumb-item active">{{ __('backend/all.language') }}</li>
	</ul>
</div>


{{-- ==Files Name Loading== --}}
@php
	for ($i=0; $i < 2; $i++) {
		if ($i == 0) {
			$place = 'backend';
		} else {
			$place = 'frontend';
		}
		$dir = 'resources/lang/bn/'.$place.'/';
		$files = glob($dir.'*php');
		$bn = array();
		foreach($files as $key => $file) {
			$bn[$key] = substr($file, strlen($dir), -4);
		}
		$dir = 'resources/lang/en/'.$place.'/';
		$files = glob($dir.'*php');
		$en = array();
		foreach($files as $key => $file) {
			$en[$key] = substr($file, strlen($dir), -4);
		}
		
		if ($i == 0) {
			$backend = array_intersect($bn,$en);
		} else {
			$frontend = array_intersect($bn,$en);
		}
	}
@endphp
{{-- ==Create Tag== --}}
<div class="row mb-3">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6 my-auto"><h2><i class="fa fa-plus-square"></i>&nbsp;{{ __('backend/all.add_name') }}</h2></div>
					<div class="col-md-6"></div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="card-body">
				<form onkeypress="return event.keyCode != 13;" action="{{ route('admin.language.insert') }}" method="post">
					@csrf
					<div class="form-group row my-5">
						<div class="col-12 col-lg-8 mx-auto my-2"> 
							<div class="input-group">
								<select required="" class="custom-select add_place" id="inputGroupSelect02" name="place">
									<option value="backend" selected="">Backend</option>
									<option value="frontend">Frontend</option>
								</select>
								<div class="input-group-append">
									<code class="input-group-text">/</code>
								</div>

								<select required="" class="form-control file_name rounded-0" name="name">
									{{-- <option id="init-select" value=""> </option> --}}
									@foreach($backend as $back)
									option
									<option class="back_hide" value="{{ $back }}" {{ $back=='default' ? 'selected':'' }} data-hide="backend">{{ $back }}</option>
									@endforeach

									@foreach($frontend as $front)
									<option class="front_hide" value="{{ $front }}" data-hide="frontend">{{ $front }}</option>
									@endforeach
								</select>
								<div class="input-group-append">
									<code class="input-group-text">.php</code>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-8 mx-auto my-2 pl-3"> 
							<div class="input-group">
								<div class="input-group-append">
									<code class="input-group-text rounded-left">[</code>
								</div>
								<input required="" placeholder="tag" class="form-control get_from" type="text" name="tag">

								<div class="input-group-append">
									<code class="input-group-text">: <small class="d-none">(bn)</small></code>
								</div>
								<input placeholder="বাংলা" required="" class="form-control avro_bn bn_focus" type="text" name="bn">
								<div class="input-group-append">
									<code class="input-group-text">: <small class="d-none">(en)</small></code>
								</div>
								<input placeholder="English" required="" class="form-control en_reform" type="text" name="en">
								<div class="input-group-append">
									<code class="input-group-text">]</code>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-8 mx-auto mt-2 pl-3">
							<button id="save_tag" class="btn btn-primary px-4 float-right" type="submit">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- ==Create File== --}}
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6 my-auto"><h2><i class="fa fa-file-code-o"></i>&nbsp;{{ __('backend/all.add_file') }}</h2></div>
					<div class="col-md-6"></div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="card-body">
				<form onkeypress="return event.keyCode != 13;" action="{{ route('admin.language.create') }}" method="post">
					@csrf
					<div class="row">

						<div class="col-12 col-lg-8 mx-auto my-5"> 
							<div class="input-group">
								<select required="" class="custom-select place" id="inputGroupSelect02" name="place">
									<option value="backend">Backend</option>
									<option value="frontend">Frontend</option>
								</select>
								<div class="input-group-append">
									<code class="input-group-text">/</code>
								</div>
								<input required="" class="file_name_ form-control" type="text" name="name" placeholder="Exm.: file_name_only">
								<div class="input-group-append">
									<code class="input-group-text">.php</code>
								</div>
								<div class="input-group-append">
									<button id="save_file" type="submit" class="btn btn-primary px-4 float-right">Save</button>
								</div>
							</div>
						</div>

						{{-- ==Hidden For Checking== --}}
						<div class="col-md-6 d-none">
							<label class="col-form-label">For :</label>
							<select class="form-control file_names_back" name="file_names_back">
								<option selected="" disabled="">Select file Name</option>
								@foreach($backend as $back)
								<option value="{{ $back }}">Backend/{{ $back }}.php</option>
								@endforeach
							</select>
							<select class="form-control file_names_front" name="file_names_front">
								<option selected="" disabled="">Select file Name</option>
								@foreach($frontend as $front)
								<option value="{{ $front }}">Frontend/{{ $front }}.php</option>
								@endforeach
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{!! asset('public/backend/js/material_input.js') !!}"></script>
<script type="text/javascript" charset="utf-8">

	$(function(){
		$('input[name=bn]').avro({
			'bangla':true
		});
	});


	$(document).ready(function() {

		$('.file_name').select2(); //Select2
		$('.file_name option[data-hide="frontend"]').prop('disabled', true); //Select2

		var $check__ = $('.add_place option:selected').text();
		if($('.file_name option:selected').text().match($check__) == $check__){
			$('span.alert_front_back').text('Select '+$('.add_place').find(":selected").text()+'/***.php');
			$('span.alert_front_back').css({'color':'green'});
			$('#save_tag').removeAttr('disabled');
		} else {
			$('#save_tag').attr('disabled')
		}
		//Warning to select directory Backend/Frontend
		$('.add_place').on('change', function() {
			let selected = this.value;

			$('.file_name option').removeAttr('selected');

			// $('#init-select').attr('selected', 'selected');

			$('.file_name').val([]); //Select2

			$('.file_name').select2({
			    placeholder: "Select File",
			});

			if (selected == 'backend') {
				$('.file_name option[data-hide="frontend"]').prop('disabled', true);
				$('.file_name option[data-hide="backend"]').prop('disabled', false);
			} else {
				$('.file_name option[data-hide="backend"]').prop('disabled', true);
				$('.file_name option[data-hide="frontend"]').prop('disabled', false);
			}

		});
		//English Name Re-Formeing
		$('.bn_focus').blur(function() {
			$('.en_reform').val($('.get_from').val());
		// }
		// $('.en_reform').blur(function() {
			var str = $('.en_reform').val();
			str = str.replace(/-/g, ' ').replace(/_/g, ' ').toLowerCase();
			str = str.replace(/\b[a-z]/g, function(letter) {
				return letter.toUpperCase();
			});
			$('.en_reform').val(str);
		});

		//File Existence Checking
		var optionValues_back = [];
		$('.file_names_back option').each(function() {
			optionValues_back.push($(this).val());
		});
		var optionValues_front = [];
		$('.file_names_front option').each(function() {
			optionValues_front.push($(this).val());
		});
		//New File Suggession
		$('.file_name_').blur(function() {
			var str = $('.file_name_').val();
			str = str.replace(/-/g, '_').replace(/\s+/g, '_').toLowerCase();
			$('.file_name_').val(str);

			if(jQuery.inArray($('.file_name_').val(), optionValues_back) !== -1 && $('.place').find(":selected").text() == 'Backend')
			{
				$('.file_name_').val($('.file_name_').val()+'_');
				$('#save_file').attr({'disabled':'disabled'});
				alert('"'+str+'" exists in backend directory');
			} else if(jQuery.inArray($('.file_name_').val(), optionValues_front) !== -1 && $('.place').find(":selected").text() == 'Frontend')
			{
				$('.file_name_').val($('.file_name_').val()+'_');
				$('#save_file').attr({'disabled':'disabled'});
				alert('"'+str+'" exists in frontend directory');
			} else {
				$('#save_file').removeAttr('disabled');
			}
		});
	});


</script>
@endsection
