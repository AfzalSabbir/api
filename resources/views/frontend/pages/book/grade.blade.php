@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.book').' '.__('backend/default.browse'))

@section('styles')
  @include('frontend.partials.owl-carousel.style')
@endsection

@section('content')
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container px-0 px-lg-2">
    <div class="row">
      <div class="col-lg-9">
        {{-- @foreach ($carousel as $key => $element)
          @include('frontend.partials.owl-carousel.carousel-grade', ['books' => $element, 'grade' => $key])
        @endforeach --}}
        @if ($total > $items)
        <div class="form-row">
          <!-- Paginaiton -->
          @include('frontend.partials.pagination', ['table' => $books])
        </div>
        @endif
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
                        <br/>
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
@endsection