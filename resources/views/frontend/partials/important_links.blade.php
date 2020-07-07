@php
	if (Auth::guard('admin')->check()) {
		$links = \App\Models\Shortcut::orderBy('serial', 'asc')
		->where(
			[
				['route', '!=', 'login'],
			]
		)
		->get();
	}else {
		$links = \App\Models\Shortcut::orderBy('serial', 'asc')
		->where(
			[
				['route', '!=', 'logout'],
				['route', '!=', 'message.inbox']
			]
		)
		->get();
	}

	$count = $links->count();
@endphp
<!-- links -->
<div class="mt-3 px-1 text-justify">
	@foreach ($links as $link)
		@if ($link->route == 'logout')
			<form id="shortcut-logout-form" class="d-none" action="{{ route('logout') }}" method="post" accept-charset="utf-8">
				@csrf
				<button id="shortcut-logout" type="submit"></button>
			</form>

			<a
				id="view-logout"
				@click.prevent=""
				onclick="$(document).ready(function() { $('#shortcut-logout-form').submit(); });"
				href="{{ $link->params ? route($link->route, json_decode($link->params)):route($link->route) }}"
				class="text-muted"
				title=""
			>
				{{ check_locale('bn') ? $link->title_bn:$link->title }}
			</a>
			@if ($loop->index < $count-1)
				&bull;
			@endif
		@else
			@if ($link->route == 'search.book')
				<a
					id="nav-search-button"
					@click.prevent=""
					onclick="$(document).ready(function() { $('#nav-search-input').click(); });"
					href="{{ $link->params ? route($link->route, json_decode($link->params)):route($link->route) }}"
					class="text-muted"
					title="Click and type..."
				>
					{{ check_locale('bn') ? $link->title_bn:$link->title }}
				</a>
			@else
				<a href="{{ $link->params ? route($link->route, json_decode($link->params)):route($link->route) }}" class="text-muted" title="">{{ check_locale('bn') ? $link->title_bn:$link->title }}</a>
			@endif
			@if ($loop->index < $count-1)
				&bull;
			@endif
		@endif
	@endforeach
</div>
<!-- /links -->