@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.add_book'))

@section('styles')
  @include('frontend.partials.owl-carousel.style')
@endsection

@section('content')
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container px-0 px-lg-2">
    <div class="row">
      <div class="col-lg-9">
        <div class="row">
          <div class="col-md-8">
            <add-book
            grades      = "{{ json_encode($grades->toArray()) }}"
            districts   = "{{ json_encode($districts->toArray()) }}"
            upazilas    = "{}"
            upazila_url = "{{ route('axios.upazila') }}"
            admin       = "{{ Auth::guard('admin')->check() ? json_encode(Auth::guard('admin')->user()):"{}" }}"
            locale_store= @php  @endphp
            >
              @csrf
            </add-book>
          </div>
        </div>
      </div>
      <div class="col-lg-3 d-none d-lg-block">
        @include('frontend.partials.grade', ['right_side' => $carousel])
        @include('frontend.partials.important_links')
      </div>
    </div>
  </div>
</div><!-- /.page-inner -->
@endsection

@section('scripts')
  @include('frontend.partials.owl-carousel.script')
@endsection