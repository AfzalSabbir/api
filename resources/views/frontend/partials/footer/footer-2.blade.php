      @php($site_setting = session()->get('site_setting'))
      <section class="py-5 bg-black text-white">
        <!-- .container -->
        <div class="container">
          <!-- .row -->
          <div class="row">
            <!-- .col -->
            <div class="col-12 col-md-12 col-lg-3">
              <!-- Brand -->
              {{-- <img src="{{ asset(session()->get('site_setting')->logo) }}" alt=""> --}}
              <p class="text-muted mb-2">{{ __('backend/default.a_product_by:') }}</p>
              <span style="position: relative;font-family: 'Niconne';font-size: 3.5rem;font-weight: 600;line-height: 55px;">
                <span class="text-light">
                  <span class="">A</span><sup class=""><span>r</span><span>s</span></sup>
                </span>
                <span class="text-primary" style="position: absolute;left: 52px;/*left: 66px;*/">
                  <small class=""><span>s</span><span>s</span></small><span class="">N</span>
                </span>
              </span>
              <address class="text-muted">
                <abbr title="BD phone code">+880</abbr> {{ $site_setting->mobile }} </address><!-- Social -->
                <p>
                  <a class="d-block" href="mailto:afzalbd1@gmail.com">afzalbd1@gmail.com</a>
                  <a class="d-block" href="mailto:boinaw.com@gmail.com">boinaw.com@gmail.com</a>
                </p>
              <ul class="list-inline mb-4 mb-md-0">
                <li class="list-inline-item mr-3 aos-init aos-animate" data-aos="fade-in" data-aos-delay="0">
                  <a href="{{ $site_setting->facebook }}" class="text-muted text-decoration-none" title="Facebook"><i class="fab fa-2x fa-facebook-f"></i></a>
                </li>
                <li class="list-inline-item mr-3 aos-init aos-animate" data-aos="fade-in" data-aos-delay="0">
                  <a href="{{ $site_setting->twitter }}" class="text-muted text-decoration-none" title="Twitter"><i class="fab fa-2x fa-twitter"></i></a>
                </li>
                <li class="list-inline-item mr-3 aos-init aos-animate" data-aos="fade-in" data-aos-delay="100">
                  <a href="#" class="text-muted text-decoration-none" title="Instagram"><i class="fab fa-2x fa-instagram"></i></a>
                </li>
                <li class="list-inline-item mr-3 aos-init aos-animate" data-aos="fade-in" data-aos-delay="100">
                  <a href="{{ $site_setting->linkedin }}" class="text-muted text-decoration-none" title="Linkedin"><i class="fab fa-2x fa-linkedin-in"></i></a>
                </li>
              </ul>

              <p class="mt-2 mt-md-3 text-left">
                <a rel="license" title="This work is licensed under a Creative Commons Attribution-NonCommercial 4.0 International License" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" src="{{ asset('public/images/other/license_by-nc_88x31.png') }}" style="border-width:0; height: 26px;" /></a>

                <a href="//www.dmca.com/Protection/Status.aspx?ID=452fac93-7d1a-4a3f-9493-5f1971dfbd51" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/dmca-badge-w150-5x1-08.png?ID=452fac93-7d1a-4a3f-9493-5f1971dfbd51"  alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                <a rel="noopener" class="copyrighted-badge" title="Copyrighted.com Registered &amp; Protected" target="_blank" href="https://www.copyrighted.com/website/IQ7kTZ6PBYUn6GjO"><img alt="Copyrighted.com Registered &amp; Protected" border="0" width="125" height="25" srcset="https://static.copyrighted.com/badges/125x25/01_2_2x.png 2x" src="https://static.copyrighted.com/badges/125x25/01_2.png" /></a><script src="https://static.copyrighted.com/badges/helper.js"></script>
              </p>
              <style> .dmca-badge img { border-radius: 12px; overflow: hidden; margin: 2px 0; } .copyrighted-badge img { border-radius: 2px; overflow: hidden; margin: 2px 0; } </style>
            </div><!-- /.col -->
            <!-- .col -->
            <div class="col-4 col-md-4 col-lg-2 mb-3 mb-md-0">
              <!-- Heading -->
              <strong class="mb-3 h6 d-block"> {{ __('backend/default.company') }} </strong><!-- links -->
              <ul class="list-unstyled mb-4">
                <li class="mb-2">
                  <a href="{{ route('about') }}" class="text-muted">{{ __('backend/default.about_us') }}</a>
                </li>
              </ul>
              <!-- Heading -->
              <strong class="mb-3 h6 d-block"> {{ __('backend/default.product') }} </strong><!-- links -->
              <ul class="list-unstyled">
                <li class="mb-2">
                  <a href="#" class="text-muted">{{ __('backend/default.boinaw') }}</a>
                </li>
              </ul>
            </div><!-- /.col -->
            <!-- .col -->
            <div class="col-4 col-md-4 col-lg-2 mb-3 mb-md-0">
              <!-- Heading -->
              <strong class="mb-3 h6 d-block"> {{ __('backend/default.help') }} </strong><!-- links -->
              <ul class="list-unstyled">
                <li class="mb-2">
                  <a href="#" class="text-muted">{{ __('backend/default.help_center') }}</a>
                </li>
                <li class="mb-2">
                  <a href="#" class="text-muted">{{ __('backend/default.documentation') }}</a>
                </li>
                <li class="mb-2">
                  <a href="#" class="text-muted">{{ __('backend/default.technical_support') }}</a>
                </li>
                <li class="mb-2">
                  <a href="#" class="text-muted">{{ __('backend/default.FAQ') }}</a>
                </li>
              </ul>
            </div><!-- /.col -->
            <!-- .col -->
            <div class="col-4 col-md-4 col-lg-2 mb-3 mb-md-0">
              <!-- Heading -->
              <strong class="mb-3 h6 d-block"> {{ __('backend/default.legal') }} </strong><!-- links -->
              <ul class="list-unstyled">
                <li class="mb-2">
                  <a href="{{ route('privacy') }}" class="text-muted">{{ __('backend/default.privacy_policy') }}</a>
                </li>
                <li class="mb-2">
                  <a href="{{ route('terms') }}" class="text-muted">{{ __('backend/default.terms_and_conditions') }}</a>
                </li>
                <li class="mb-2">
                  <a href="{{ route('cookies') }}" class="text-muted">{{ __('backend/default.cookies_policy') }}</a>
                </li>
                <li class="mb-2">
                  <a href="{{ route('sitemap.root') }}" class="text-muted">{{ __('backend/default.sitemap') }}</a>
                </li>
              </ul>
            </div><!-- /.col -->
            <!-- .col -->
            <div class="col-12 col-md-12 col-lg-3 mb-3 mb-md-0">
              <strong class="mb-3 h6 d-block"> {{ __('backend/default.description') }} </strong><!-- links -->
              <p class="text-muted text-justify">
                {!! $site_setting->description !!}
              </p>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <!-- .row -->
          <div class="row">
            <ul class="list-inline mx-auto mt-5 text-center">
              <li class="list-inline-item pb-2">
                @if (session()->get('locale')=='bn')
                  <a class="text-muted" href="{{ route('language', 'en') }}" title="Change Language">{{ __('backend/default.locale') }}</a>
                @else
                  <a class="text-muted" href="{{ route('language', 'bn') }}" title="ভাষা পরিবর্তন করুন">{{ __('backend/default.locale') }}</a>
                @endif
              </li>
              <li class="list-inline-item pb-2">
                <a class="text-muted" href="#">{{ __('backend/default.support') }}</a>
              </li>
              <li class="list-inline-item pb-2">
                <a class="text-muted" href="#">{{ __('backend/default.help_center') }}</a>
              </li>
              <li class="list-inline-item pb-2">
                <a class="text-muted" href="{{ route('privacy') }}">{{ __('backend/default.privacy') }}</a>
              </li>
              <li class="list-inline-item pb-2">
                <a class="text-muted" href="{{ route('terms') }}">{{ __('backend/default.terms_and_conditions') }}</a>
              </li>
            </ul>
            <p class="text-muted text-center w-100"> &copy; {{ n2l(date('Y')) }} <a href="{{ route('home') }}" title="{{ __('backend/default.boinaw') }}">{{ __('backend/default.boinaw') }}</a> - {{ __('backend/default.all_rights_reserved') }} {{ __('backend/default..') }} </p>
          </div><!-- /.row -->
        </div><!-- /.container -->
      </section>