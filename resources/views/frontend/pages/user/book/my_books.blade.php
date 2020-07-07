{{-- Full Structure --}}
@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.profile').' - '.__('backend/default.my_books'))

{{-- Write Styles <style>In Here</style> --}}
@section('styles')
@endsection

{{-- This Section Will Shown <body>In Here</body> --}}
@section('content')
{{-- @include('frontend.partials.profile.profile_banner') --}}
@include('frontend.partials.profile.profile_nav')
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 order-2 order-md-1">
        @include('frontend.partials.profile.book_sidebar')
      </div>
      <div class="col-lg-9 order-1 order-md-2">
				<div class="card card-fluid radius-0 border-primary box-shadow">
				  <div class="card-header border-0 bg-primary text-white rounded-0 py-2">
				    <a class="card-title mb-0"><i class="fad fa-books"></i> {{ __('backend/default.my_books') }} </a>
				  </div>
		      @if (!$books->isEmpty())
    				<div class="card-body py-0">
			      	@foreach ($books as $book)
			        <!-- .list-group -->
			        <div class="list-group list-group-flush list-group-divider">
			          <!-- .list-group-item -->
			          <div class="list-group-item">
			            <div class="list-group-item-figure pl-0">
			              <a href="{{ route('book.view.slug', $book->slug) }}" class="user-avatar user-avatar-md"><img class="lazyload" src="{{ asset('public/images/BoiNaw_lazyload.jpg') }}" data-src="{{ asset($book->photo) }}" onerror='this.src="{{ asset('public/images/BoiNaw_error.jpg') }}"' alt='{{ $book->title }}' /></a>
			            </div>
			            <div class="list-group-item-body">
			              <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
			                <div class="team w-100 w-md-50">
			                  <h4 class="list-group-item-title ellipsis">
			                    <a href="{{ route('book.view.slug', $book->slug) }}">{{ $book->title }}</a> 
			                  </h4>
			                  <p class="list-group-item-text ellipsis">
			                    <small>{{ n2l($book->created_at->diffForHumans()) }}</small>
			                  </p>
			                </div>
			                <ul class="list-inline text-muted mb-0">
			                  <li class="list-inline-item mr-3" data-toggle="tooltip" title="" data-placement="top" data-original-title="{{ __('backend/default.comment') }}">
			                    <i class="fas fa-comment text-info"></i> {{ n2l(count($book->comment)) }}
			                  </li>
			                  <li class="list-inline-item mr-3" data-toggle="tooltip" title="" data-placement="top" data-original-title="{{ __('backend/default.price') }}">
			                    <i class="fa fa-coins text-yellow"></i> {{ n2l((int)$book->cost) }} 
			                  </li>
			                  <li class="list-inline-item mr-3" data-toggle="tooltip" title="" data-placement="top" data-original-title="{{ count($book->who_asked) == 0 ? '':($book->taken_by_id > 0 ? __('backend/default.taken'):__('backend/default.belled')) }}">
			                    <i class="fa fa-bell {{ count($book->who_asked) == 0 ? 'text-white':($book->taken_by_id > 0 ? 'text-teal':'text-muted') }}"></i> {{ n2l(count($book->who_asked)) }} 
			                  </li>
			                </ul>
			              </div>
			            </div>
			            @if ($book->admin_id == Auth::guard('admin')->user()->id)
				            <div class="list-group-item-figure pr-0">
				              <div class="dropdown">
				                <span @click.prevent class="btn btn-sm btn-icon rounded-right {{ $book->taken_by_id > 0 ? 'btn-success text-white':'btn-secondary' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                  <i class="fas fa-ellipsis-h"></i>
				                </span>
				                <!-- .dropdown-menu -->
				                <div class="dropdown-menu dropdown-menu-right stop-propagation p-1 text-center" style="min-width: 1rem;">
				                  <div class="dropdown-arrow"></div>
				                  <div class="btn-group">
				                  	{{-- deleteConfirm('{{ route('profile.book.delete') }}', '{{ encrypt($book->id) }}', '{{ route('profile.my_books') }}') --}}
				                    <a href="{{ route('profile.book.bell_list', $book->slug) }}" class="mb-0 btn btn-xs btn-light float-right rounded-0">
				                      <span class="text-success text-nowrap">{{ __('backend/default.bells') }}</span>
				                    </a>
				                    <a class="mb-0 btn btn-xs btn-light float-right rounded-0" onclick="local_deleteThis('{{ route('profile.book.delete') }}', '{{ encode_base64($book->id) }}', '{{ route('profile.my_books') }}', true)">
				                      <span class="text-red">{{ __('backend/default.delete') }}</span>
				                    </a>
				                    <a href="{{ route('profile.edit_book', $book->slug) }}" class="mb-0 btn btn-xs btn-light float-right rounded-0">
				                      <span class="text-teal">{{ __('backend/default.edit') }}</span>
				                    </a>
				                    <a href="{{ route('book.view.slug', $book->slug) }}" class="mb-0 btn btn-xs btn-light float-right rounded-0">
				                      <span class="text-primary">{{ __('backend/default.view') }}</span>
				                    </a>
				                  </div>
				                </div><!-- /.dropdown-menu -->
				              </div>
				            </div>
			            @else
				            <div class="list-group-item-figure pr-0">
				              <div class="dropdown">
				                <span @click.prevent class="btn btn-sm btn-icon btn-secondary rounded-left" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				                  <i class="fas fa-ellipsis-h"></i>
				                </span>
				                <!-- .dropdown-menu -->
				                <div class="dropdown-menu dropdown-menu-right stop-propagation p-1 text-center" style="min-width: 1rem;">
				                  <div class="dropdown-arrow"></div>
				                  <div class="btn-group">
				                    <a class="mb-0 btn btn-xs btn-warning float-right rounded-0">
				                      <span>{{ __('backend/default.report') }}</span>
				                    </a>
				                    <a href="{{ route('book.view.slug', $book->slug) }}" class="mb-0 btn btn-xs btn-info float-right rounded-0">
				                      <span>{{ __('backend/default.view') }}</span>
				                    </a>
				                  </div>
				                </div><!-- /.dropdown-menu -->
				              </div>
				            </div>
			            @endif
			          </div><!-- /.list-group-item -->
			        </div><!-- /.list-group -->
			      	@endforeach
			      </div>
	    			@if ($items < $total)
	      		<div class="card-footer border-0">
			         @include('frontend.partials.pagination', ['table' => $books])
	      		</div>
	    			@endif
          @else
      			<div class="card-body p-0">
              <div class="alert alert-warning has-icon m-0 rounded-0" role="alert">
                <div class="alert-icon">
                  <span class="oi oi-info"></span>
                </div>No book available <a href="{{ route('profile.add_book') }}" class="alert-link font-weight-bold">click here</a> to add book.
              </div>
    				</div>
          @endif
    		</div>
    	</div>
    </div>
  </div>
</div><!-- /.page-inner -->
@endsection

{{-- Write Scripts <script fileType="text/javascript">In Here</script> --}}
@section('scripts')
<script>
	function local_deleteThis(url, base64_id, redirect, refresh) {
		deleteConfirm(url, base64_id, '', refresh);
	}
</script>
@endsection