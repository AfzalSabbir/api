        @php
          $alerts = ['success', 'danger', 'info', 'warning', 'primary', 'dark'];
          // $alerts = ['success', 'danger', 'info', 'warning', 'primary', 'danger', 'success', 'info', 'warning'];
          $key = rand(0, count($alerts)-1);
        @endphp
        
        <div class="{{-- form-row --}} rounded-0 bpx px-2 alert alert-{{ $alert }}">
          <div class="col-12 d-flex justify-content-between align-items-center h6 px-0">
            {{ $title }} <a class="btn btn-sm btn-{{ $alert }}" href="{{ route($view_all_route) }}">@lang('backend/default.view_all') {{-- (<span class="">{{ n2l(count($books)) }}</span>) --}}</a>
          </div>
          <div class="owl-carousel owl-theme">
            @foreach ($books as $element)
            @break($loop->index + 1 > 16)
            <div class="item">
              <!-- .card -->
              <div class="card card-figure mb-2">
                <!-- .card-figure -->
                <figure class="figure">
                  <!-- .figure-img -->
                  <div class="figure-img text-center">
                    <img class="img-fluid owl-lazy" width="200" {{-- data-src-retina="{{ asset('public/images/BoiNaw_lazyload.jpg') }}" --}} data-src="{{ asset($element->photo) }}" alt="{{ $element->title }}">
                    <div class="figure-description text-left pt-2 px-0">
                      <strong class="mb-2 d-block"><i class="oi oi-book mr-1"></i>{{ $element->title }}</strong>
                      <p class="mb-0">
                        <span class="text-danger d-flex" title="{{ __('backend/default.location') }}"><i class="oi oi-map-marker mr-2"></i> {{ $element->location }}</span>
                        <span class="text-info d-flex" title="{{ __('backend/default.edition') }}"><i class="oi oi-pencil mr-1"></i> {{ $element->edition }}</span>
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
                    <strong class="figure-title d-block">
                      <a href="{{ route('book.view.slug', $element->slug) }}" title="{{ $element->title }}">{{ $element->title }}</a>
                    </strong>
                    {{-- <p class="text-muted mb-0"> Give some text description </p> --}}
                  </figcaption><!-- /.figure-caption -->
                  <figcaption class="figure-caption mt-0">
                    <ul class="list-inline d-flex text-info mb-0">
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
        </div>