<!-- .card -->
<div class="card card-fluid rounded-0 border-primary">
  <div class="card-header border-0 bg-primary text-white rounded-0 py-2">
    <a class="card-title mb-0"> {{ __('backend/default.book') }} </a>
  </div>
  <!-- .nav -->
  <nav class="nav nav-tabs flex-column border-0">
    <a href="{{ route('profile.add_book') }}" class="nav-link py-2 {{ Route::is('profile.add_book') ? 'active text-primary bg-muted':'' }}"><i class="fad fa-books-medical"></i> {{ __('backend/default.add_book') }}</a>
    <a href="{{ route('profile.my_books') }}" class="nav-link py-2 {{ Route::is('profile.my_books') ? 'active text-primary bg-muted':'' }}"><i class="fad fa-books"></i> {{ __('backend/default.my_books') }}</a>
  </nav><!-- /.nav -->
</div><!-- /.card -->