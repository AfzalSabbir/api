<!-- .card -->
<div class="card card-fluid rounded-0 border-primary">
	<div class="card-header border-0 bg-primary text-white rounded-0 py-2">
		<a class="card-title mb-0"><i class="fad fa-user-cog"></i> {{ __('backend/default.profile') }} </a>
	</div>
	<nav class="nav nav-tabs flex-column border-0">
		<a href="#profile" @click.prevent data-id="profile_profile" class="profile_setting_toggles nav-link py-2 active text-primary bg-muted"><i class="fad fa-user-tie"></i> {{ __('backend/default.public_profile') }}</a>
		<a href="#personal" @click.prevent data-id="profile_personal" class="profile_setting_toggles nav-link py-2"><i class="fad fa-user-lock"></i> {{ __('backend/default.personal_profile') }}</a>
		<a href="#password" @click.prevent data-id="profile_password" class="profile_setting_toggles nav-link py-2"><i class="fad fa-key"></i> {{ __('backend/default.change_password') }}</a>
		{{-- <a href="#social" data-id="profile_social" class="profile_setting_toggles nav-link py-2"><i class="fad fa-id-card-alt"></i> {{ __('backend/default.social_profile') }}</a> --}}
	</nav>
</div><!-- /.card -->