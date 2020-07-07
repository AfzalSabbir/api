@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.book').' '.__('backend/default.browse'))

@section('styles')
  @include('frontend.partials.owl-carousel.style')
  <style>
    a.list-group-item:hover {background: #f7f9fc;}
  </style>
@endsection

@section('content')

@php
  $texts = ['text-primary',/*'text-secondary',*/'text-success','text-info','text-warning','text-danger',/*'text-light',*/'text-dark','text-transparent','text-blue','text-indigo','text-purple','text-pink','text-red','text-orange','text-yellow','text-green','text-teal','text-cyan','text-gray','text-gray-dark',/*'text-white',*/'text-muted','text-black','text-facebook','text-facebook','text-twitter','text-twitter','text-linkedin','text-linkedin','text-apple','text-apple','text-google','text-google','text-google_plus','text-google_plus','text-youtube','text-youtube','text-vimeo','text-vimeo','text-pinterest','text-pinterest','text-yelp','text-yelp','text-dribbble','text-dribbble','text-amazon','text-amazon','text-ebay','text-ebay','text-skype','text-skype','text-instagram','text-instagram','text-dropbox','text-dropbox','text-flickr','text-flickr','text-github','text-github','text-basecamp','text-basecamp','text-tumblr','text-tumblr','text-foursquare','text-foursquare','text-box','text-box'];
  $tot_texts = count($texts);
@endphp

<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container px-0 px-lg-2">
    <div class="row">
      <div class="col-lg-9">
        <div class="list-group-bordered list-group-reflow border-primary bg-white box-shadow mb-3">
          <span class="col-12 list-group-item justify-content-between align-items-center border-0 bg-primary text-white rounded-0 font-weight-bold">
            {{ __('backend/default.'.$location) }}
          </span>
          <span class="location-container">
            @if (!$locations->isEmpty())
              @foreach ($locations as $element)
              @php($text_index = rand(0, 9999)%$tot_texts)
              <!-- .list-group-item -->
              <a href="{{ route('book.upazila.upazila_name.browse', [$element->slug]) }}" class="col-12 col-sm-6 col-md-4 col-lg-3 list-group-item justify-content-between align-items-center border-0">
                <span data-toggle="tooltip" title="{{ (check_lang('bn') ? $element->name_bn:$element->name).__('backend/default.:').' '.n2l($element->total) }}" class="ellipsis"><i class="fas fa-square {{ $texts[$text_index] }} mr-2"></i>{{ check_lang('bn') ? $element->name_bn:$element->name }}</span>
                <span class="text-muted badge badge-subtle badge-primary">{{ n2l($element->total) }}</span>
              </a><!-- /.list-group-item -->
              @endforeach
            @else
              @include('frontend.partials.alerts.nothing_to_show')
            @endif
          </span>
        </div>

        @foreach ($carousel as $key => $element)
          @include('frontend.partials.owl-carousel.carousel-grade', ['books' => $element, 'grade' => $key])
        @endforeach

      </div>
      <div class="col-lg-3 d-none d-lg-block">
        @include('frontend.partials.grade', ['right_side' => $carousel])
        @include('frontend.partials.important_links')
      </div>
    </div>
  </div><!-- /.page-inner -->
</div><!-- /.page-inner -->
@endsection

@section('scripts')
  @include('frontend.partials.owl-carousel.script')
@endsection