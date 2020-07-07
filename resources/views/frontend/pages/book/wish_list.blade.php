@extends('frontend.layouts.master')

@section('fav_title', (Route::is(['profile.my_wish_list']) ? __('backend/default.my'):__('backend/default.book')).' '.__('backend/default.wish_list'))

@section('styles')
<style>
  .blockquote, blockquote {font-size: 1.1em;color: #363642;border-left: 4px solid #346cb02e !important;}
  .collapse-indicator .fa-chevron-down {color: #346cb099 !important;}
  .card-expansion-item.border-primary {border: 1px solid #346cb02e !important;border-left: 0 !important;border-right: 0 !important;}
  .card-expansion-item.border-primary:first-child {border-top: 0 !important;}
  .pl-1p {padding-left: 1px;}


  .bg-primary{background: #14141f!important;}
  .text-primary, .a{color: #14141f!important;}
  .border-primary{border: 1px solid #14141f!important;}
  .badge-subtle.badge-primary, .page-link:hover, .page-item.active .page-link{color: #14141f!important;background-color: #14141f0f!important;}
  [data-toggle=collapse] .collapse-indicator {color: #888c9b !important;}
  .blockquote, blockquote {font-size: 1.1em;color: #363642;border-left: 4px solid #14141f2e !important;}
  .collapse-indicator .fa-chevron-down{color: #14141f99 !important;}
  .card-expansion-item.border-primary{border: 1px solid #14141f2e !important;border-left: 0 !important;border-right: 0 !important;}
  .fill-black {fill: var(--dark)!important;}
  .bg-dark, .bg-black {background: var(--dark)!important;}
  .dropdown-item.active, .dropdown-item:active, .dropdown-item:focus, .dropdown-item:hover{background-color: #14141ffc;}
  .wish{border: 1px dashed;border-radius: 2px;}
</style>
@endsection

@section('content')
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container px-0 px-lg-2">
    <div class="row">
      <div class="col-lg-6">
        <div class="card rounded-0 border-primary box-shadow">

          <!-- .card-header -->
          <div class="card-header list-group-item justify-content-between align-items-center border-0 bg-primary text-white rounded-0 font-weight-bold">
            <span>
              <span class="wish-list">{{ (Route::is(['profile.my_wish_list']) ? __('backend/default.my').' ':'').__('backend/default.wish_list') }}</span>
              <span class="add-wish" style="display: none">{{ __('backend/default.write_your_wish') }}</span>
            </span>

            @if (Auth::guard('admin')->check())
              <span class="text-white px-1 wish">
                @if (Route::is(['profile.my_wish_list']))
                  <span class="new-wish cursor-pointer text-white-h" title="{{ __('backend/default.add_wish') }}">{{ __('backend/default.wish') }}</span>
                @else
                  <span class="my-wishes cursor-pointer text-white-h" onclick='window.location="{{ route('profile.my_wish_list') }}"' title="{{ __('backend/default.my_wish_list') }}">{{ __('backend/default.my_wish_list') }}</span>
                @endif
              </span>
            @endif
          </div><!-- /.card-header -->
          <!-- .card-body -->
          @if (Auth::guard('admin')->check())
            <div class="card-expansion mb-0 wish-container" style="display: none;">
              <add-wish
                grades      = "{{ json_encode($grades->toArray()) }}"
                districts   = "{{ json_encode($districts->toArray()) }}"
                upazilas    = "{}"
                upazila_url = "{{ route('axios.upazila') }}"
                url         = "{{ route('book.axios.store_wish') }}"
                admin       = "{{ Auth::guard('admin')->check() ? json_encode(Auth::guard('admin')->user()):"{}" }}"
                old_inputs  = "{{ count(session()->getOldInput()) > 0 ? 1:0 }}"
                form_errors = "{{ json_encode($errors->any() ? $errors->all():0) }}"
                >
                @csrf
              </add-wish>
          </div>
          @endif
          <div id="accordion2" class="card-expansion mb-0 wish-items bg-dark">
            @if (!$wish_list->isEmpty())
              @foreach ($wish_list as $element)
              @php($collapse = $element->id)
              <!-- .card -->
              <div class="card card-expansion-item rounded-0 border-primary border-left-0 border-right-0 box-shadow-none">
                <div class="card-header border-0 p-0" id="heading{{ $loop->index }}">
                  <button class="btn btn-reset d-flex justify-content-between w-100 pb-0 pt-2 px-1 px-lg-2 collapsed" data-toggle="collapse" data-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                    <span>
                      <blockquote class="text-left mb-2">
                        <p class="mb-0"> {{ $element->title }} </p>
                        <footer><cite title="{{ __('backend/default.author') }}">{{ $element->writer }}</cite></footer>
                      </blockquote>
                    </span> <span class="collapse-indicator"><i class="fa fa-fw fa-chevron-down"></i></span>
                  </button>
                </div>
                <div id="collapse{{ $loop->index }}" class="collapse px-1 px-lg-2" aria-labelledby="heading{{ $loop->index }}" data-parent="#accordion2" style="">
                  <div class="card-body pt-1 px-0 pb-2">
                    <ul class="list-group pb-2">
                      <li class="list-group-item px-2 px-lg-2 pb-1 border-bottom bg-light rounded-0">
                        <a href="#" class="btn-account" role="button">
                          <div class="user-avatar user-avatar-lg">
                            <img src="{{ asset($element->admin->photo) }}" alt="">
                          </div>
                          <div class="account-summary">
                            <p class="account-name"> {{ $element->admin->name }} </p>
                            <p class="account-description"> {{ n2l($element->created_at->diffForHumans()) }} </p>
                          </div>
                        </a>
                      </li>
                      <li class="list-group-item px-2 px-lg-2 py-0 pt-2">
                        <span class="col-4 col-lg-3 px-0 font-weight-bold">
                          {{ __('backend/default.grade') }}<span class="float-right pr-2">: </span>
                        </span>
                        <span class="col-8 col-lg-9 px-0">
                          <span class="d-inline-block">{{ $element->grade->title }}</span>
                        </span>
                      </li>
                      <li class="list-group-item px-2 px-lg-2 py-0">
                        <span class="col-4 col-lg-3 px-0 font-weight-bold">
                          {{ __('backend/default.edition') }}<span class="float-right pr-2">: </span>
                        </span>
                        <span class="col-8 col-lg-9 px-0">
                          <span class="d-inline-block">{{ $element->edition }}</span>
                        </span>
                      </li>
                      <li class="list-group-item px-2 px-lg-2 py-0">
                        <span class="col-4 col-lg-3 px-0 font-weight-bold">
                          {{ __('backend/default.contact') }}<span class="float-right pr-2">: </span>
                        </span>
                        <span class="col-8 col-lg-9 px-0">
                          <span class="d-inline-block">{!!
                          n2l($element->district->name.', '.$element->upazila->name.', '.$element->location.'.<br />'.$element->contact) !!}</span>
                        </span>
                      </li>
                      <li class="list-group-item px-2 px-lg-2 py-0">
                        <span class="col-4 col-lg-3 px-0 font-weight-bold">
                          {{ __('backend/default.description') }}<span class="float-right pr-2">: </span>
                        </span>
                        <span class="col-8 col-lg-9 px-0">
                          <span class="d-inline-block">{{ $element->description }}</span>
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div><!-- /.card -->
              @endforeach
            @else
              <div class="alert alert-warning has-icon mb-0 rounded-0" role="alert">
                <div class="alert-icon">
                  <span class="oi oi-info"></span>
                </div>No wish available. <a href="#" class="new-wish font-weight-bold" title="">click here</a> to wish
              </div>
            @endif
          </div><!-- /.card-body -->
          @if($total > count($wish_list))
          <!-- .card-footer -->
          <div class="card-footer border-0">
            {{-- <a href="#" class="card-footer-item">View report <i class="fa fa-fw fa-angle-right"></i></a> --}}
            <!-- Paginaiton -->
            @include('frontend.partials.pagination', ['table' => $wish_list])
          </div><!-- /.card-footer -->
          @endif
        </div>
      </div>
      <div class="offset-3 col-lg-3 d-none d-lg-block">
        @include('frontend.partials.grade', ['right_side' => $carousel])
        @include('frontend.partials.important_links')
      </div>
    </div>
  </div><!-- /.page-inner -->
</div><!-- /.page-inner -->
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
      $('.new-wish').click(function(){
        @if (Auth::guard('admin')->check())
          $('.wish-items').fadeToggle();
          $('.wish-container').slideToggle();
          $('.card-footer').toggle();
          $('.wish-list').toggle();
          $('.add-wish').toggle();
        @else
          toastr.warning('{{ __('backend/default.signin_first') }}');
        @endif
      });
  });
</script>
@endsection