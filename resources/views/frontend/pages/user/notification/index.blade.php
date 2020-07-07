@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.notification'))

@section('styles')
  @include('frontend.partials.owl-carousel.style')
  <style> 
    .text-muted a {color: var(--muted);}
    .log-divider:before {top: 1.2em !important;}
    .notification-side-item a {text-decoration: none;}
  </style>
@endsection

@section('content')
{{-- @include('frontend.partials.profile.profile_nav') --}}
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container px-0 px-lg-2">
    <notification-card
      url="{{ route('notification.axios.history') }}"
      url_read_all="{{ route('notification.axios.read_all') }}"
      url_delete_this="{{ route('notification.axios.delete_this') }}"
      url_this_read="{{ route('notification.axios.read_this_notification') }}"
      url_search="{{ route('notification.axios.search') }}"
    ></notification-card>
  </div>
</div><!-- /.page-inner -->
@endsection

@section('scripts')
  @include('frontend.partials.owl-carousel.script')
@endsection