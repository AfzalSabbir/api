<!-- Full Structure -->
@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.profile'))

<!-- Write Styles <style>In Here</style> -->
@section('styles')
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
@include('frontend.partials.profile.profile_nav')
	<!-- .page-inner -->
	<div class="page-inner pt-2 pb-0">
		<div class="container">
			<!-- .page-title-bar -->
			<header class="page-title-bar mb-0">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active">
							<a href="{{ route('profile') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i> {{ __('backend/default.overview') }} </a>
						</li>
					</ol>
				</nav>
			</header><!-- /.page-title-bar -->
			<!-- .page-section -->
			<div class="page-section">
				<!-- grid row -->
				<div class="row">
					<!-- grid column -->
					<div class="col-lg-3">
        				@include('frontend.partials.profile.book_sidebar')
						@include('frontend.partials.profile.profile_setting_sidebar')
					</div>
					<div class="col-lg-9">
					</div>
				</div>
			</div>
		</div>
	</div>

  <!-- /.page-inner -->
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
@endsection