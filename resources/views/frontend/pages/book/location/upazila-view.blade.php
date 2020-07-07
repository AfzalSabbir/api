@extends('frontend.layouts.master')

@section('fav_title', check_lang('bn') ? $upazila->bn_name:$upazila->name)

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
          <span id="upazila-toggle" class="col-12 list-group-item justify-content-between align-items-center border-0 bg-primary text-white rounded-0 font-weight-bold {{ !$locations->isEmpty() ? 'cursor-pointer':'' }}" title="{{ !$locations->isEmpty() ? 'Show/Hide Union':'' }}">
            {{ check_lang('bn') ? $upazila->bn_name:$upazila->name }}

            @if (!$locations->isEmpty())
              <span>#</span>
            @endif

          </span>
          <span class="location-container" style="display: none !important;">
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

        @if (!$books->isEmpty())
          <div class="form-row">
            @foreach ($books as $element)
            <div class="col-6 col-xl-3 col-lg-4 col-sm-6">
              <!-- .card -->
              <div class="card card-figure mb-2">
                <!-- .card-figure -->
                <figure class="figure">
                  <!-- .figure-img -->
                  <div class="figure-img text-center">
                    <img class="img-fluid lazyload" width="200" src="{{ asset('public/images/BoiNaw_lazyload.jpg') }}" data-src="{{ asset($element->photo) }}">
                    <div class="figure-description text-left pt-2 px-0">
                      <h6 class="figure-title"><i class="oi oi-book _oi mr-1"></i> {{ $element->title }}</h6>
                      <p class="mb-0">
                        <span class="text-danger d-flex" title="{{ __('backend/default.location') }}"><i class="oi oi-map-marker _oi text-danger mr-1"></i> {{ $element->location }}</span>
                        <span class="text-info d-flex" title="{{ __('backend/default.edition') }}"><i class="oi oi-pencil _oi text-info mr-1"></i> {{ $element->edition }}</span>
                      </p>
                    </div>
                    {{-- <div class="figure-tools">
                      <a href="{{ route('book.view.slug', $element->slug) }}" class="tile tile-circle tile-sm mr-auto"><span class="oi oi-eye"></span></a> <span class="badge badge-warning">Gadget</span>
                    </div> --}}
                    <div class="figure-action">
                      
                      <view-action
                      url_delete = ""
                      url_report = ""
                      url_bell = "{{ route('profile.book.bell') }}"
                      base64_id = "{{ encode_base64($element->id) }}"
                      slug = "{{ $element->slug }}"
                      redirect = ""
                      admin_id = "{{ $element->admin_id }}"
                      view = 0
                      ></view-action>
                    </div>
                  </div><!-- /.figure-img -->
                  <!-- .figure-caption -->
                  <figcaption class="figure-caption">
                    <h6 class="figure-title">
                      <a href="{{ route('book.view.slug', $element->slug) }}">{{ $element->title }}</a>
                    </h6>
                    {{-- <p class="text-muted mb-0"> Give some text description </p> --}}
                  </figcaption><!-- /.figure-caption -->
                  <figcaption class="figure-caption mt-0">
                    <ul class="list-inline d-flex text-muted mb-0">
                      <li class="list-inline-item mr-auto">
                        <span class="oi oi-clock"></span> {{ num2locale($element->created_at->diffForHumans()) }}</li>
                      <li class="list-inline-item ellipsis">
                        <span>৳ {{ num2locale((int)$element->cost) }}</span>
                      </li>
                    </ul>
                  </figcaption>
                </figure><!-- /.card-figure -->
              </div><!-- /.card -->
            </div>
            @endforeach
          </div>
          @if ($total > $items)
          <div class="form-row">
            <!-- Paginaiton -->
            @include('frontend.partials.pagination', ['table' => $books])
          </div>
          @endif
        @else
          @include('frontend.partials.alerts.no_book')
        @endif

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
  <script>
    $(document).ready(function() {
      $('#district-toggle').click(function(){
        $('.location-container').slideToggle();
      })
    });
  </script>
@endsection