
                  <!-- grades -->
                  <ul class="list-group rounded-0 border-primary p-0 bg-white">
                    <li class="list-group-item px-2 px-md-3 bg-primary rounded-0 text-white"><a class="font-weight-bold" @click.prevent="">{{ __('backend/default.grade') }}</a></li>
                    @php
                      $full_url = url()->full();
                      $exp_url = explode('/', $full_url);
                      $exp_grade = $exp_url[count($exp_url)-2];
                      $right_side_array = $right_side->toArray();
                    @endphp
                    @foreach (\App\Models\Grade::where('status', 1)->get() as $grade)
                      <!-- grade -->
                      <li class="list-group-item px-2 px-md-3 {{ $exp_grade == $grade->slug ? 'active bg-secondary':'' }}">
                        <a class="ellipsis w-100 justify-content-between align-items-center pr-5" title="{{ check_lang('bn') ? $grade->title_bn:$grade->title }} [{{ array_key_exists($grade->id, $right_side_array) ? n2l(count($right_side[$grade->id])):n2l(0) }}]" href="{{ route('book.grade.browse', $grade->slug) }}">
                          <span class="a">{{ check_lang('bn') ? $grade->title_bn:$grade->title }}</span>
                          <span class="badge badge-subtle badge-primary position-absolute r-3">{{ array_key_exists($grade->id, $right_side_array) ? n2l(count($right_side[$grade->id])):n2l(0) }}</span></a>
                      </li><!-- /grade -->
                    @endforeach
                  </ul>
                  <!-- /grades -->