@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.search'))

@section('styles')
  @include('frontend.partials.owl-carousel.style')
  <style>
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
      color: #fff;
      background-color: transparent;
      font-weight: bold;
      border-color: #346cb0;
    }
  </style>
@endsection

@section('content')
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container px-0 px-lg-2">
    <div class="row">
      <div class="col-lg-6">
        <search-card
        filter="{{ request()->f ? request()->f : ''  }}"
        type="{{ request()->t ? request()->t : ''  }}"
        page="{{ request()->page ? request()->page : 1  }}"
        query="{{ request()->q }}"
        action="{{ route('search.book') }}"
        result="{{ !is_null($search) ? json_encode($search):'{}' }}"
        url_report = "{{ route('profile.book.report') }}"
        ></search-card>
      </div>
      <div class="col-lg-3 d-none d-lg-block">
        <div class="board p-0 perfect-scrollbar ps ps--active-y d-none">
          <!-- .list-group -->
          <div class="list-group list-group-flush list-group-divider border-top" data-toggle="radiolist">
            <!-- .list-group-item -->
            <div class="list-group-item active" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-blue"> Z </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Zathunicon, Inc. </h4>
                <p class="list-group-item-text"> San Francisco, United States </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-indigo"> F </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Faxquote </h4>
                <p class="list-group-item-text"> Pekalongan, Indonesia </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-purple"> O </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Opentech </h4>
                <p class="list-group-item-text"> Los Angeles, United States </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-pink"> C </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Codehow </h4>
                <p class="list-group-item-text"> Mexico City, Mexico </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-red"> R </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Ron-tech </h4>
                <p class="list-group-item-text"> Pekalongan, Indonesia </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-orange"> G </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Groovestreet </h4>
                <p class="list-group-item-text"> London, United Kingdom </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-yellow"> B </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Bioplex et Chandon </h4>
                <p class="list-group-item-text"> Hyderabad, India </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-green"> S </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Streethex </h4>
                <p class="list-group-item-text"> Mexico City, Mexico </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-teal"> H </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Hottechi Motor Company, Ltd </h4>
                <p class="list-group-item-text"> Jakarta, Indonesia </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-cyan"> N </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Newex </h4>
                <p class="list-group-item-text"> Tokyo, Japan </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-blue"> F </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Finjob </h4>
                <p class="list-group-item-text"> Paris, France </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-indigo"> S </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Sonron, Inc. </h4>
                <p class="list-group-item-text"> Beijing, China </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-purple"> D </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Doncon </h4>
                <p class="list-group-item-text"> Delhi, India </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-pink"> C </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> Conecom </h4>
                <p class="list-group-item-text"> São Paulo, Brazil </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item" data-toggle="sidebar" data-sidebar="show">
              <a href="#" class="stretched-link"></a> <!-- .list-group-item-figure -->
              <div class="list-group-item-figure">
                <div class="tile tile-circle bg-red"> J </div>
              </div><!-- /.list-group-item-figure -->
              <!-- .list-group-item-body -->
              <div class="list-group-item-body">
                <h4 class="list-group-item-title"> J-Texon Systems, Inc. </h4>
                <p class="list-group-item-text"> New York City, United States </p>
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
            <!-- .list-group-item -->
            <div class="list-group-item">
              <!-- .list-group-item-body -->
              <div class="list-group-item-body text-center py-4">
                <!-- .spinner -->
                <div class="spinner-border text-primary" role="status">
                  <span class="sr-only">Loading...</span>
                </div><!-- /.spinner -->
              </div><!-- /.list-group-item-body -->
            </div><!-- /.list-group-item -->
          </div><!-- /.list-group -->
        </div>
      </div>
      <div class="col-lg-3 d-none d-lg-block">
        @include('frontend.partials.grade', ['right_side' => $carousel])
      </div>
    </div>
  </div><!-- /.page-inner -->
</div><!-- /.page-inner -->
@endsection

@section('scripts')
  @include('frontend.partials.owl-carousel.script')
@endsection