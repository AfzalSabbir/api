<!-- SubMenu -->
@php
	$all_menu = \App\Models\Menu::get()->keyBy('id')->toArray();
@endphp

@if($thisSubMenus)
	@foreach($thisSubMenus as $thisSubMenu)
		@php
			$itsParentRoute = $all_menu[$thisSubMenu['parent_id']]['route'];
			$itsParentsParentId = $all_menu[$thisSubMenu['parent_id']]['parent_id'];
		@endphp

		@if($thisSubMenu['menu'] != "Action" && in_array($thisSubMenu['id'], $mySubMenus))
			@if(strlen($itsParentRoute) > 0 && is_null($itsParentsParentId))
				@php($modalName = strtolower(current(explode(' ', $thisSubMenu['menu']))) == 'add' ? strtolower(current(explode(' ', $thisSubMenu['menu']))).'_new':/*strtolower(end(explode(' ', $thisSubMenu['menu']))).'_all'*/'')
				<span data-toggle="tooltip" data-html="true" title="{{ Config::get('app.locale') == 'en' ? $thisSubMenu['menu']:$thisSubMenu['menu_bn'] }}"><span type="button" class="btn btn-primary py-1 {{ Route::is($thisSubMenu['route']) ? 'active' : '' }}" data-toggle="modal" data-target="#{{ $modalName }}"><i class="{{ $thisSubMenu['icon'] }}"></i></span></span>
			@else
				<a href="{{ route($thisSubMenu['route']) }}" class="btn btn-primary py-1 {{ Route::is($thisSubMenu['route']) ? 'active' : '' }}" data-toggle="tooltip" data-html="true" title="{{ Config::get('app.locale') == 'en' ? $thisSubMenu['menu']:$thisSubMenu['menu_bn'] }}"><i class="{{ $thisSubMenu['icon'] }}"></i></a>
			@endif
		@endif
	@endforeach
@endif