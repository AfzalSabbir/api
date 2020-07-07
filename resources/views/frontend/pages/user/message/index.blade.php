@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.message'))

@section('styles')
  @include('frontend.partials.owl-carousel.style')
  <style>
    .text-muted a {color: var(--muted);}
    .log-divider:before {top: 1.2em !important;}
  </style>
@endsection

@section('content')
{{-- @include('frontend.partials.profile.profile_nav') --}}
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container px-0 px-lg-2">
    <message-card
      url="{{ route('message.axios.inbox') }}"
      url_read_all="{{ route('message.axios.read_all') }}"
      url_delete_this="{{ route('message.axios.delete_this') }}"
      url_this_read="{{ route('message.axios.read_this_message') }}"
      url_search="{{ route('message.axios.search') }}"
    ></message-card>
  </div>
</div><!-- /.page-inner -->
@endsection

@section('scripts')
  @include('frontend.partials.owl-carousel.script')
@endsection