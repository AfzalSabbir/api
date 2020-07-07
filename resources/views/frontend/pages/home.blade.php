@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.home'))

@section('meta')
    @php
      $key0 = "BoiNaw, Boi Naw, Boi, Naw, বইনাও, বই নাও, বই, নাও";
      $meta = 'BoiNaw.com - ArsssN Co., Ltd.';
      $description = 'Home page of the site - here you\'ll find book whose are in a group/sorted manner';
      $keys = $key0.', '.str_replace(' ', ', ', preg_replace('/[,:.]/', '', $description)).', '.$description;
      $description .= '. '.$meta;
    @endphp
    <meta name="description" content="{{ $description }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $keys }}">
    <meta property="og:type" content="product" />
    <meta property="og:image" content="{{ asset('public/images/BoiNaw_lazyload.jpg') }}" />
    <meta property="og:price:currency" content="BDT" />
@endsection
@section('description', $description)

@section('sidebar', 'has-sidebar')

@section('styles')
  @include('frontend.partials.owl-carousel.style')
  <style>
    .btn{white-space: nowrap;}
  </style>
@endsection

@section('content')
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container px-0 px-lg-2">
    <div class="row">
      <div class="col-lg-9">

        @includeWhen($new->isEmpty() && $free->isEmpty() && $carousel->isEmpty(), 'frontend.partials.alerts.no_book')

        {{-- Latest --}}
        @includeWhen(!$new->isEmpty(), 'frontend.partials.owl-carousel.carousel', ['books' => $new, 'title' => __('backend/default.new'), 'view_all_route' => 'book.browse', 'alert' => 'info'])
        {{-- Free --}}
        @includeWhen(!$free->isEmpty(), 'frontend.partials.owl-carousel.carousel', ['books' => $free, 'title' => __('backend/default.free'), 'view_all_route' => 'book.browse.free', 'alert' => 'success'])

        @if(!$carousel->isEmpty()) <hr /> @endif

        {{-- Grade --}}
        @foreach ($carousel as $key => $element)
          @includeWhen(!$element->isEmpty(), 'frontend.partials.owl-carousel.carousel-grade', ['books' => $element, 'grade' => $key])
        @endforeach

      </div>
      <div class="col-lg-3 d-none d-lg-block">
        @include('frontend.partials.grade', ['right_side' => $carousel])
        @include('frontend.partials.important_links')
        {{-- <hr class="text-muted" /> --}}
      </div>
    </div>
  </div><!-- /.page-inner -->
</div><!-- /.page-inner -->
<!-- .page-sidebar -->
<div class="page-sidebar">
  <!-- .sidebar-header -->
  <header class="sidebar-header d-sm-none">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">
          <a href="#" onclick="Looper.toggleSidebar()"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Back</a>
        </li>
      </ol>
    </nav>
  </header><!-- /.sidebar-header -->
  <!-- .sidebar-section -->
  <div class="sidebar-section">
    <button type="button" class="close mt-n1 d-none d-sm-block" onclick="Looper.toggleSidebar()" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h6> I'm a sidebar </h6>
  </div><!-- /.sidebar-section -->
</div><!-- /.page-sidebar -->
@endsection

@section('scripts')
  @include('frontend.partials.owl-carousel.script')
@endsection