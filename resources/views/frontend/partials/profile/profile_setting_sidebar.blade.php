<!-- .card -->
<div class="card card-fluid rounded-0 border-primary">
	<div class="card-header border-0 bg-primary text-white rounded-0 py-2">
		<a class="card-title mb-0"> {{ __('backend/default.settings') }} </a>
	</div>
	<nav class="nav nav-tabs flex-column border-0">
		<a href="{{ route('profile.setting') }}" class="nav-link py-2 {{ Route::is('profile.setting') ? 'active text-primary bg-muted':'' }}"><i class="fad fa-user-cog"></i> {{ __('backend/default.profile') }}</a>
		{{-- <a href="{{ route('account.setting') }}" class="nav-link py-2 {{ Route::is('account.setting') ? 'active text-primary bg-muted':'' }}"><i class="fad fa-hammer"></i> {{ __('backend/default.account') }}</a> --}}
	</nav>
</div><!-- /.card -->