@extends('frontend.layouts.master')

@section('fav_title', $book->title)

@section('meta')
    {{-- <meta property="og:description" content="Custom Printed Eco Friendly New Tpe Yoga Mats , Find Complete Details about Custom Printed Eco Friendly New Tpe Yoga Mats,Tpe Yoga Mats,Eco Friendly Tpe Yoga Mats,Yoga Matt from Yoga Mats Supplier or Manufacturer-Fuqing Shengde Plastic &amp; Rubber Products Co., Ltd." /> --}}
    @php
      $key0 = "BoiNaw, Boi Naw, Boi, Naw, বইনাও, বই নাও, বই, নাও";
      $meta = 'BoiNaw.com - ArsssN Co., Ltd.';
      $description = 'Book Name: '.$book->title.', '.
                    'Authors: '.$book->writer.', '.
                    'Price: '.$book->cost.', '.
                    'Edition: '.$book->edition.', '.
                    'Contact: '.$book->district->name.', '.$book->upazila->name.', '.$book->location;
      $keys = $key0.', '.str_replace(' ', ', ', preg_replace('/[,:]/', '', $description)).', '.$description;
      $description .= '. '.$meta;

      $demo_users = ['testuser1','testuser2','testuser3','testuser4','testuser5','testuser6'];
    @endphp
    <meta name="description" content="{{ $description }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $keys }}">

    <meta property="og:type" content="product" />
    <meta property="og:image" content="{{ asset($book->photo) }}" />
    <meta property="og:price:amount" content="{{ $book->cost > 0 ? $book->cost:0 }}" />
    <meta property="og:price:currency" content="BDT" />

    {{-- <meta property="fb:admins" content="100002227819697,124207444332529" /> --}}
    {{-- <meta property="fb:page_id" content="22437985072" /> --}}
    {{-- <meta property="fb:app_id" content="124207444332529" /> --}}
    {{-- <meta name="google-translate-customization" content="9de59014edaf3b99-22e1cf3b5ca21786-g00bb439a5e9e5f8f-f" /> --}}
    {{-- <meta name="aplus-exdata" content='{"productId":"60345111510","companyId":"235438165"}'> --}}
@endsection
@section('description', $description)

@section('styles')
  @include('frontend.partials.owl-carousel.style')
  <style>
    .confirm-bell {
      position: absolute;
      right: 0;
      top: 0;
      background-image: url({{ asset('public/images/tool/check-bg-min.png') }});
      background-repeat: no-repeat;
      background-size: cover;
      border-top-left-radius: unset !important;
      border-bottom-right-radius: unset !important;
    }
    .card{border-radius: .25rem !important;}
  </style>
@endsection

@section('content')
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="row">
          <div class="col-md-5">

            <blockquote class="text-left d-block d-md-none {{ in_array($book->admin->username, $demo_users) ? 'alert-warning':'' }}">
              <h3 class="product-title">{{ $book->title }}</h3>
              @foreach(explode(';', $book->writer) as $writer)
                <footer>
                  <span class="mb-0">
                    {{ $writer }}
                  </span>
                </footer>
              @endforeach
              <div class="d-flex justify-content-between">
                <small>
                  <i>{{ __('backend/default.post') }} : </i><button style="" type="button" class="btn btn-xs btn-secondary py-0 px-1 border-0 text-primary view-m-t"
                  data-container="body"
                  data-html="true"
                  data-toggle="popover"
                  data-placement="top"
                  data-trigger="focus"
                  data-content="
                    <div class='col-12 my-auto p-0' @click.prevent>
                      <div class='media list-group-item justify-content-between align-items-center border-0 text-decoration-none p-0 cursor-pointer' style='margin: auto -8px;'>
                        <a class='user-avatar user-avatar-md mr-1'><img src='{{ asset($book->admin->photo) }}' onerror='this.src={{ asset('public/images/BoiNaw_error.jpg') }}' alt='{{ $book->title }}'></a>
                        <div class='media-body'>
                          <h3 class='card-title ellipsis'>
                            <a>{{ $book->admin->name }}</a>
                          </h3>
                          <h6 class='card-subtitle text-muted'> {{ n2l($book->created_at->diffForHumans()) }} </h6>
                        </div>
                      </div>
                    </div>
                  "
                  title=""
                  data-original-title="{{ $book->title }}"
                  aria-describedby="">{{ '@'.$book->admin->username }}</button>
                  <br />
                  <sub>{{ n2l($book->created_at->diffForHumans()) }}</sub>
                </small>
                <small class="text-muted" style="margin-top: 24px;">
                  <sub class="mt-4">@lang('backend/default.visits_x_time', ['visits' => n2l($visits > 0 ? $visits:0)])</sub>
                </small>
              </div>
            </blockquote>

            <div class="preview-pic tab-content">
              <div class="tab-pane active position-relative" id="pic-5">
                <img class="img-thumbnail w-100 lazyload" src="{{ asset('public/images/BoiNaw_lazyload.jpg') }}" onerror="this.src='{{ asset('public/images/BoiNaw_error.jpg') }}'" data-src="{{ change_quality(asset($book->photo)) }}" alt="{{ $book->title }}">
                @if ($book->taken_by_id > 0)
                <i class="fad fa-check text-primary fa-4x rounded bg-secondary px-0 border confirm-bell"></i>
                @endif
              </div>
            </div>
            
          </div>
          <div class="details col-md-7 mt-2 mt-md-0">
            <blockquote class="text-left d-none d-md-block {{ in_array($book->admin->username, $demo_users) ? 'alert-warning':'' }}">
              <h3 class="product-title">{{ $book->title }}</h3>
              @foreach(explode(';', $book->writer) as $writer)
                <footer>
                  <span class="mb-0">
                    {{ $writer }}
                  </span>
                </footer>
              @endforeach
              <div class="d-flex justify-content-between">
                <small>
                  <i>{{ __('backend/default.post') }} : </i><button style="" type="button" class="btn btn-xs btn-secondary py-0 px-1 border-0 text-primary view-m-t"
                  data-container="body"
                  data-html="true"
                  data-toggle="popover"
                  data-placement="top"
                  data-trigger="focus"
                  data-content="
                    <div class='col-12 my-auto p-0' @click.prevent>
                      <div class='media list-group-item justify-content-between align-items-center border-0 text-decoration-none p-0 cursor-pointer' style='margin: auto -8px;'>
                        <a class='user-avatar user-avatar-md mr-1'><img src='{{ asset($book->admin->photo) }}' alt=''></a>
                        <div class='media-body'>
                          <h3 class='card-title ellipsis'>
                            <a>{{ $book->admin->name }}</a>
                          </h3>
                          <h6 class='card-subtitle text-muted'> {{ n2l($book->created_at->diffForHumans()) }} </h6>
                        </div>
                      </div>
                    </div>
                  "
                  title=""
                  data-original-title="{{ $book->title }}"
                  aria-describedby="popover333256">{{ '@'.$book->admin->username }}</button>
                  <br />
                  <sub>{{ n2l($book->created_at->diffForHumans()) }}</sub>
                </small>
                <small class="text-muted" style="margin-top: 21px;">
                  <sub class="mt-4">@lang('backend/default.visits_x_time', ['visits' => n2l($visits > 0 ? $visits:0)])</sub>
                </small>
              </div>
            </blockquote>
            <ul class="list-group box-shadow-none">
              <li class="list-group-item bg-transparent p-0 px-1 px-md-0">
                <span class="col-4 col-lg-3 px-0 font-weight-bold">
                  {{ __('backend/default.condition') }}<span class="float-right pr-2">: </span>
                </span>
                <span class="col-8 col-lg-9 px-0">
                  <span class="d-inline-block">
                    @switch($book->book_condition)
                      @case(2) <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-muted"></i> (@lang('backend/default.good')) @break
                      @case(3) <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i> (@lang('backend/default.new')) @break
                      @default <i class="fa fa-star text-warning"></i><i class="fa fa-star text-muted"></i><i class="fa fa-star text-muted"></i> (@lang('backend/default.old'))
                    @endswitch
                  </span>
                </span>
              </li>
              <li class="list-group-item bg-transparent p-0 px-1 px-md-0">
                <span class="col-4 col-lg-3 px-0 font-weight-bold">
                  {{ __('backend/default.price') }}<span class="float-right pr-2">: </span>
                </span>
                <span class="col-8 col-lg-9 px-0">
                  <span class="d-inline-block">{!! n2l((int)$book->cost > 0 ? $book->cost.'<small>৳</small>': __('backend/default.free')) !!}</span>
                </span>
              </li>
              <li class="list-group-item bg-transparent p-0 px-1 px-md-0">
                <span class="col-4 col-lg-3 px-0 font-weight-bold">
                  {{ __('backend/default.edition') }}<span class="float-right pr-2">: </span>
                </span>
                <span class="col-8 col-lg-9 px-0">
                  <span class="d-inline-block">{{ $book->edition }}</span>
                </span>
              </li>
              <li class="list-group-item bg-transparent p-0 px-1 px-md-0">
                <span class="col-4 col-lg-3 px-0 font-weight-bold">
                  {{ __('backend/default.grade') }}<span class="float-right pr-2">: </span>
                </span>
                <span class="col-8 col-lg-9 px-0">
                  <span class="d-inline-block">{{ check_lang('bn') ? $book->grade->title_bn : $book->grade->title }}</span>
                </span>
              </li>
              <li class="list-group-item bg-transparent p-0 px-1 px-md-0">
                <span class="col-4 col-lg-3 px-0 font-weight-bold">
                  {{ __('backend/default.contact') }}<span class="float-right pr-2">: </span>
                </span>
                <span class="col-8 col-lg-9 px-0">
                  <span class="d-inline-block">{!!
                  n2l((check_locale('bn')?$book->district->bn_name:$book->district->name).', '.(check_locale('bn')?$book->upazila->bn_name:$book->upazila->name).', '.$book->location.'.<br />'.$book->contact) !!}</span>
                </span>
              </li>
              @if (!Auth::guard('admin')->check())
              <li class="list-group-item bg-transparent p-0 px-1 px-md-0">
                <span class="col-4 col-lg-3 px-0 font-weight-bold">
                  {{ __('backend/default.comment') }}<span class="float-right pr-2">: </span>
                </span>
                <span class="col-8 col-lg-9 px-0">
                  <span class="d-inline-block"></span>
                </span>
              </li>
              @endif
            </ul>
            {{-- @dd(decode_base64('T0Rjd05tSTNOMDU2U21oWlYwWm9UWHBuTVZsUlBUMD0%3D')) --}}
            {{-- <hr /> --}}
            @if (Auth::guard('admin')->check())
            <view-action
            url_delete = "{{ route('profile.book.delete') }}"
            url_report = "{{ route('profile.book.report') }}"
            url_bell = "{{ route('profile.book.bell') }}"
            {{-- url_bell_list = "{{ route('profile.book.bell_list', $book->slug) }}" --}}
            base64_id = "{{ encode_base64($book->id) }}"
            slug = "{{ $book->slug }}"
            redirect = "{{ route('profile.my_books') }}"
            admin_id = "{{ $book->admin_id }}"
            view = 1
            ></view-action>
            @endif
            
            {{-- <hr /> --}}
            <front-comment
              url         = "{{ route('admin.book.comment', encode_base64($book->id)) }}"
              post_url    = "{{ route('admin.book.axios_comment', encode_base64($book->id)) }}"
              book_id     = "{{ encode_base64($book->id) }}"
              book_detail = "{{ json_encode($book) }}"
              comments    = "{{ json_encode($comments) }}"
              admin       = "{{ Auth::guard('admin')->check() ? json_encode(Auth::guard('admin')->user()):"{}" }}"
            >
              @csrf
            </front-comment>
          </div>
        </div>
      </div>
      <div class="col-lg-3 d-none d-lg-block">
        @include('frontend.partials.grade', ['right_side' => $carousel])
        @include('frontend.partials.important_links')
      </div>
    </div>
  </div><!-- /.page-inner -->
</div><!-- /.page-inner -->
{{-- <a href="" style="display: none;" id="comment-to" title="">#</a> --}}
@endsection

@section('scripts')
  @include('frontend.partials.owl-carousel.script')
  <script>
    $(document).ready(function() {
      $('.contact').click(function () {
        alert('contact');
      });
      /*let comment_id = window.location.href.split('#')['1'];

      $('#comment-to').attr('href', '#'+comment_id);
      $('#comment-to').click();*/
    });
  </script>
@endsection