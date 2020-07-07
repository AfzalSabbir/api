<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/database.Insert_database') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
	<link href="{{ asset('public/plugins/Text-Editor-With-Line-Numbers-jQuery-LinedTextDiv/linedTextEditor-jquery.css') }}" rel="stylesheet">
	<style type="text/css">
		textarea#insert {
			background: var(--sidebar-deep);
			color: var(--nav-normal);
			line-height: 16px !important;
    		font-size: 12px !important;
		}
	</style>
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
<!-- Top Management Part -->
<div class="app-title">
	<div>
		<h1><i class="{{ 'fa fa-life-saver' }}"></i> {{ __('backend/database.database_management') }}</h1>
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
					<div class="col-md-6"><h2><i class="{{ 'fa fa-pencil-square' }}"></i> .env</h2></div>
					<div class="col-md-6 text-right"><button id="form-submit" type="button" class="btn btn-primary">{{ __('backend/default.save') }}</button></div>
					<div class="clearfix"></div>

				</div>
			</div>

			<div class="card-body p-0">
				@include('backend.partials.error_message')
			    @php
			      $save_token = base64_encode(rand(1111,9999));
			      session()->flash('env_save_token', $save_token);
			    @endphp
			    @if(Session::has('success'))
					<div class="alert-info my-0 px-2 py-3 h4">Last <strong><code>.env</code></strong> data backuped in <strong><code>.env.backup</code></strong> file</div>
				@endif
				<form class="form-horizontal" action="{{ route('admin.env.save', $save_token) }}" method="post" enctype="multipart/form-data">
					@csrf
					{{-- <textarea name="insert" rows="{{ count($env) }}" class="insert form-control" id="insert">@foreach($env as $row){!! trim($row).'<br>' !!} @endforeach</textarea> --}}
					<pre><textarea spellcheck="false" name="insert" rows="{{ $rows+3 }}" class="insert form-control rounded-0" id="insert">{{ $env }}</textarea></pre>

					<button type="submit" id="form-submit-target" class="btn btn-primary float-right mx-3 mb-3">{{ __('backend/default.save') }}</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('#form-submit').click(function(event) {
			$('#form-submit-target').click();
		});
	});
</script>
@endsection