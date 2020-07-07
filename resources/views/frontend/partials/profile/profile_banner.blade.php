
            <!-- .page-cover -->
            <header class="page-cover">
              <div class="text-center">
                <a href="#" class="user-avatar user-avatar-xl"><img src="{{ asset(Auth::guard('admin')->user()->photo) }}" alt=""></a>
                <h2 class="h4 mt-2 mb-0"> {{ Auth::guard('admin')->user()->name }} </h2>
                <p class="text-muted mension"> {{ '@'.Auth::guard('admin')->user()->username }} </p>
                <p class="mb-0">
                  <i class="fad fa-mobile"></i>
                  @if(Auth::guard('admin')->user()->mobile)
                    {{ Auth::guard('admin')->user()->mobile }}
                  @else
                    <span class="text-warning" title="{!! __('backend/default.setting').'&gt;'.__('backend/default.profile').'&gt;'.__('backend/default.public_profile') !!}">{{ __('backend/default.mobile_not_set_yet') }}</span>
                  @endif
                </p>
                <p class="mb-0">
                  <i class="fad fa-envelope"></i>
                  {{ Auth::guard('admin')->user()->email }}
                </p>
              </div><!-- .cover-controls -->
              {{-- <div class="cover-controls cover-controls-bottom">
                <a href="#" class="btn btn-light" data-toggle="modal" data-target="#followersModal">2,159 Followers</a> <a href="#" class="btn btn-light" data-toggle="modal" data-target="#followingModal">136 Following</a>
              </div> --}}<!-- /.cover-controls -->
            </header><!-- /.page-cover -->