<ul id="app-menu-DEV" class="app-menu pb-0 bg-theme" style="border-bottom: 8px solid  var(--nav-deep); {{ env('APP_DEVELOPER_TOOL_ALWAYS') ? 'display: block;':'display: none;' }}">
  <li class="treeview {{ (Route::is('admin.menu.index') || Route::is('admin.menu.create') || Route::is('admin.menu.edit') || Route::is('admin.menu.sort')) ? 'is-expanded' : '' }}">
    <a class="app-menu__item {{ (Route::is('admin.menu.index') || Route::is('admin.menu.create') || Route::is('admin.menu.edit') || Route::is('admin.menu.sort')) ? 'active' : '' }}" href="#" data-toggle="treeview">
      <i class="app-menu__icon py-1 fa fa-laptop"></i>
      <span class="app-menu__label">{{ __('backend/sidebar.menu') }}</span>
      <i class="treeview-indicator fa fa-angle-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a class="treeview-item {{ Route::is('admin.menu.index') ? 'active_submenu' : '' }}" href="{{ route('admin.menu.index') }}"><i class="fa fa-list fa-fw"></i>  {{ __('backend/sidebar.menu_list') }}</a></li>
      <li><a class="treeview-item {{ Route::is('admin.menu.create') ? 'active_submenu' : '' }}" href="{{ route('admin.menu.create') }}" rel="noopener"><i class="fa fa-plus fa-fw"></i>  {{ __('backend/sidebar.add_menu') }}</a></li>
      <li><a class="treeview-item {{ Route::is('admin.menu.sort') ? 'active_submenu' : '' }}" href="{{ route('admin.menu.sort') }}" rel="noopener"><i class="fa fa-sort-amount-asc fa-fw"></i>  {{ __('backend/sidebar.sort') }}</a></li>
      <li><a class="treeview-item {{ Route::is('admin.role.assign.super_admin') ? 'active_submenu' : '' }}" href="{{ route('admin.role.assign.super_admin') }}" rel="noopener"><i class="fa fa-bolt fa-fw"></i>  {{ __('backend/sidebar.assign') }}</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a class="app-menu__item cursor-alias {{ Route::is('admin.database.insert') ? 'active_submenu' : '' }}" href="{{ route('admin.database.insert') }}" target="_blank"><i class="app-menu__icon py-1 fa fa-database"></i><span class="app-menu__label">{{ __('backend/default.database') }}</span></a>
  </li>
  <li class="treeview">
    <a class="app-menu__item cursor-alias {{ Route::is('admin.language.index') ? 'active_submenu' : '' }}" href="{{ route('admin.language.index') }}" target="_blank"><i class="app-menu__icon py-1 fa fa-globe"></i><span class="app-menu__label">{{ __('backend/default.language') }}</span></a>
  </li>
  <li class="treeview">
    <a class="app-menu__item cursor-alias {{ Route::is('admin.root.index') ? 'active_submenu' : '' }}" href="{{ route('admin.root.index') }}" target="_blank"><i class="app-menu__icon py-1 fa fa-free-code-camp"></i><span class="app-menu__label">{{ __('backend/default.root') }}</span></a>
  </li>
  <li class="treeview">
    <a class="app-menu__item cursor-alias {{ Route::is('admin.module.index') ? 'active_submenu' : '' }}" href="{{ route('admin.module.index') }}" target="_blank"><i class="app-menu__icon py-1 fa fa-puzzle-piece"></i><span class="app-menu__label">{{ __('backend/default.modules') }}</span></a>
  </li>
  <li class="treeview">
    @php
      $read_token = base64_encode(rand(1111,9999));
      session()->flash('env_read_token', $read_token);
    @endphp
    <a class="app-menu__item {{ Route::is('admin.env.read') ? 'active_submenu' : '' }}" href="{{ route('admin.env.read', $read_token) }}"><i class="app-menu__icon py-1 fa fa-life-saver"></i><span class="app-menu__label">.env</span></a>
  </li>
  <li class="treeview">
    <a class="app-menu__item" href="#" data-toggle="treeview">
      <i class="app-menu__icon py-1 fa fa-link"></i>
      <span class="app-menu__label">{{ __('backend/sidebar.important_links') }}</span>
      <i class="treeview-indicator fa fa-angle-right"></i>
    </a>
    <ul class="treeview-menu">
      <li>
        <a class="treeview-item cursor-alias" target="_blank" href="{{ 'https://www.adolfocuadros.com/sql_to_laravel/' }}"><i class="fa fa-linode fa-fw"></i>  SQL to Migration</a>
      </li>
      <li>
        <a class="treeview-item cursor-alias" target="_blank" href="{{ 'https://pratikborsadiya.in/vali-admin/index.html' }}"><i class="fa fa-cubes fa-fw"></i>  Vali - Theme</a>
      </li>
    </ul>
  </li>
</ul>
<script type="text/javascript">
  $(document).ready(function() {
    $('.app-header__logo').on('click', function(event) {
      event.preventDefault();
      $('#app-menu-DEV').slideToggle();
    });
  });
</script>