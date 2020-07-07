<!-- Full Structure -->
@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.profile').' - '.__('backend/default.book').' - '.$book->title.' - '.__('backend/default.bell_list_people'))

<!-- Write Styles <style>In Here</style> -->
@section('styles')
<style>
  a.user-avatar:focus {
    box-shadow: none !important;
  }
  .dotted-x {
    border-right: 1px dotted #ddd !important;
    /* border-left: 1px dotted #ddd !important; */
  }
</style>
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
@php
  $texts = ['text-primary',/*'text-secondary',*/'text-success','text-info','text-warning','text-danger',/*'text-light',*/'text-dark','text-transparent','text-blue','text-indigo','text-purple','text-pink','text-red','text-orange','text-yellow','text-green','text-teal','text-cyan','text-gray','text-gray-dark',/*'text-white',*/'text-muted','text-black','text-facebook','text-facebook','text-twitter','text-twitter','text-linkedin','text-linkedin','text-apple','text-apple','text-google','text-google','text-google_plus','text-google_plus','text-youtube','text-youtube','text-vimeo','text-vimeo','text-pinterest','text-pinterest','text-yelp','text-yelp','text-dribbble','text-dribbble','text-amazon','text-amazon','text-ebay','text-ebay','text-skype','text-skype','text-instagram','text-instagram','text-dropbox','text-dropbox','text-flickr','text-flickr','text-github','text-github','text-basecamp','text-basecamp','text-tumblr','text-tumblr','text-foursquare','text-foursquare','text-box','text-box'];
  $tot_texts = count($texts);
@endphp
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
      	<bell-list
      	book = "{{ json_encode($book) }}"
      	accept_history = "{{ json_encode($accept_history) }}"
      	texts = "{{ json_encode($texts) }}"
      	accept_confirm_url = "{{ route('auth.axios.confirm_bell_book') }}"
      	></bell-list>
    	</div>
    </div>
  </div>
</div><!-- /.page-inner -->
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
<script>
	function local_deleteThis(url, base64_id, redirect, refresh) {
		deleteConfirm(url, base64_id, '', refresh);
	}
</script>
@endsection