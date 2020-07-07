<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/default.wish_list') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
<!-- Top Management Part -->

<!--Remove from Comment {{--...--}} for Permission -->
{{-- Permission for Admin Access --}}

  <!-- Permission -->
  @php
    $permissions = \App\Models\Menu::orderBy('id', 'desc')->where('url', substr(url()->current(), 1+strlen(url('/'))))->orWhere('url', substr(url()->current(), strlen(url('/'))))->first();

    // 3 is user role
    if (Auth::guard('admin')->user()->admin_role == 3) {
      $myRole = \App\Models\Role::where('admin_id', Auth::guard('admin')->user()->id)->first();
    } else {
      $myRole = \App\Models\Role::where('role', Auth::guard('admin')->user()->admin_role)->first();
    }

    //get SubMenus
    $thisRoute          = \Request::route()->getName();
    $sub_menu_by_route  = \App\Helpers\ModuleHelper::get_menu_by_route($thisRoute);
    $thisSubMenus       = current($sub_menu_by_route)['childs'];
    $mySubMenus         = json_decode($myRole->sub_menu);
  @endphp

<div class="app-title">
  <div>
    <h1><i class="{{ 'fa fa-shopping-basket' }}"></i> {{ __('backend/default.wish_list') }} {{ __('backend/default.management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('backend/default.wish_list') }}</li>
  </ul>
</div>

<!-- Table Part -->
<div class="row">
  <div class="col-md-12">
    <div class="card">

      <div class="card-header">
        <div class="row">
          <div class="col-md-6 my-auto"><h2><i class="{{ 'fa fa-table' }}"></i> {{ __('backend/default.wish_list') }}</h2></div>
          <div class="col-md-6 btn-group justify-content-end">

            {{-- SubMenu --}}
            @include('backend.partials.submenu', ['thisSubMenus' => $thisSubMenus, 'mySubMenus' => $mySubMenus])
                  
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="card-body" data-my-table="table-1">
        {{-- ERROR Message --}}
        @include('backend.partials.error_message')

        <div class="toggle-table-column alert-info br-2 p-2 mb-2">
          <strong>{{ __('backend/default.table_toggle_message') }} </strong>

          <a href="#" class="toggle-vis" data-column="0"><b>{{ __('backend/default.sl') }}</b></a> |
          <a href="#" class="toggle-vis" data-column="1"><b>{{ __('backend/default.post') }}</b></a> |
          <a href="#" class="toggle-vis" data-column="2"><b>{{ __('backend/default.title') }}</b></a> |
          <a href="#" class="toggle-vis" data-column="3"><b>{{ __('backend/default.writer') }}</b></a> |
          <a href="#" class="toggle-vis hide-on-load" data-column="4"><b>{{ __('backend/default.edition') }}</b></a> |
          <a href="#" class="toggle-vis" data-column="5"><b>{{ __('backend/default.grade') }}</b></a> |
          <a href="#" class="toggle-vis" data-column="6"><b>{{ __('backend/default.cost') }}</b></a> |
          <a href="#" class="toggle-vis hide-on-load" data-column="7"><b>{{ __('backend/default.contact') }}</b></a> |

          {{-- <a href="#" class="toggle-vis hide-on-load" data-column="8"><b>{{ __('backend/default.status') }}</b></a> | --}}
          <a href="#" class="toggle-vis" data-column="8"><b>{{ __('backend/default.action') }}</b></a>

        </div>

        <div class="table-responsive pt-1">
          <!-- Search and Select -->
          @include('backend.partials.pagination_page_numbering', ['route' => Route::currentRouteName(), 'items' => $items, 'total' => $total])
          <table id="my-table" {{-- id="datatable" --}} class="table table-bordered table-hover rounded display">

            <thead>
              <th>{{ __('backend/default.sl') }}</th>
              <th>{{ __('backend/default.post') }}</th>
              <th>{{ __('backend/default.title') }}</th>
              <th>{{ __('backend/default.writer') }}</th>
              <th>{{ __('backend/default.edition') }}</th>
              <th>{{ __('backend/default.grade') }}</th>
              <th>{{ __('backend/default.cost') }}</th>
              <th>{{ __('backend/default.contact') }}</th>

              {{-- <th>{{ __('backend/default.status') }}</th> --}}
              <th class="action">{{ __('backend/default.action') }}</th>
            </thead>

            <tbody>

              @foreach($rows as $row)
              @php($md5_id = md5($row->id))
              
              <tr class="{{ $row->status == 0 ? 'inactive_':'' }}">
                <td width="20" class="ellipsis px-1 py-2 text-center">{{ n2l($loop->index + 1) }}</td>
                <td class="ellipsis px-1 py-2 ">{{ $row->admin->name }}</td>
                <td class="ellipsis px-1 py-2 ">{{ $row->title }}</td>
                <td class="ellipsis px-1 py-2 ">{{ $row->writer }}</td>
                <td class="ellipsis px-1 py-2 ">{{ $row->edition }}</td>
                <td class="ellipsis px-1 py-2 ">
                  {{ $row->grade->title }}
                  {{-- @switch($row->grade)
                      @case(1) Primary (1-5) @break
                      @case(2) Lower Secondary (6-8) @break
                      @case(3) Secondary (9-10) @break
                      @case(4) Higher Secondary (11-12) @break
                      @case(5) Higher Education (Hons./MS/PhD) @break
                  @endswitch --}}
                </td>
                <td class="ellipsis px-1 py-2 ">{{ $row->cost }}</td>
                <td class="px-1 py-2 ">
                  {!!
                    $row->district->name.', '.$row->upazila->name.', '.$row->location.'.<br />'.$row->contact
                  !!}
                </td>

                {{-- <td>{{ $row->status == 1 ? 'Active' : 'Inactive' }}</td> --}}
                <td class="ellipsis px-1 py-0 action">
                  @if (\Auth::guard('admin')->user()->id == $row->admin_id)
                  <div class="btn-group">
                    @foreach($permissions->submenus as $key => $permission)
                      @if(\App\Models\Menu::checkBodyMenu($permission->id, $myRole->in_body))
                        {{-- @elseif($key == 1)
                          <button title="View" data-toggle="modal" data-target="#view_page{{ encrypt($row->id) }}" class="btn btn-info text-white"><i class="fa fa-eye"></i></button> --}}
                        @if($key == 0)
                          <button title="Edit" data-toggle="modal" data-target="#edit_page{{ $md5_id }}" class="btn btn-warning text-white"><i class="fa fa-edit"></i></button>
                        @else
                          <button title="Delete" class="btn text-white {{ $row->status == 0? ' btn-secondary disabled':' btn-danger' }}" onClick="deleteMethod('{{ encrypt($row->id) }}')" role="button" {{ $row->status == 0? 'disabled':'' }}><i class="fa fa-trash"></i></button>
                        @endif
                      @endif
                    @endforeach
                  </div>
                  <!-- Edit Modal -->
                  <div class="modal fade" id="edit_page{{ $md5_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square"></i> {{ __('backend/default.wish_list') }} {{ __('backend/default.update') }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('admin.wish_list.update', encrypt($row->id)) }}" method="POST">
                            @csrf

                            <div class="form-row text-left">
                              <div class="col-6">
                                <label for="title" class="label mb-1">{{ __('backend/default.title') }}</label>
                                <div>
                                  <input type="text" class="form-control mb-2" value="{{ $row->title }}" name="title" id="title_{{ $row->id }}" required>
                                </div>

                                <label for="writer" class="label mb-1">{{ __('backend/default.writer') }} </label>
                                <div>
                                  <input type="text" class="form-control mb-2" value="{{ $row->writer }}" name="writer" id="writer_{{ $row->id }}">
                                </div>
                                <label for="edition" class="label mb-1">{{ __('backend/default.edition') }}</label>
                                <div>
                                  <input type="text" class="form-control mb-2" value="{{ $row->edition }}" name="edition" id="edition_{{ $row->id }}">
                                </div>
                                <label for="grade" class="label mb-1">{{ __('backend/default.grade') }}</label>
                                <div>
                                  <select value="{{ $row->grade_id }}" name="grade" class="form-control mb-2" id="grade_{{ $row->id }}" required>
                                    <option disabled="" selected="">-- Select Grade --</option>
                                    <option value="5" {{ $row->grade_id == 5 ? 'selected':'' }}>Higher Education (Hons./MS/PhD)</option>
                                    <option value="4" {{ $row->grade_id == 4 ? 'selected':'' }}>Higher Secondary (11-12)</option>
                                    <option value="3" {{ $row->grade_id == 3 ? 'selected':'' }}>Secondary (9-10)</option>
                                    <option value="2" {{ $row->grade_id == 2 ? 'selected':'' }}>Lower Secondary (6-8)</option>
                                    <option value="1" {{ $row->grade_id == 1 ? 'selected':'' }}>Primary (1-5)</option>
                                  </select>
                                </div>
                                <label for="cost" class="label mb-1">{{ __('backend/default.cost') }}</label>
                                <div>
                                  <input type="number" class="form-control mb-2" value="{{ $row->cost }}" name="cost" id="cost_{{ $row->id }}" value="0" required>
                                </div>
                              </div>
                              <div class="col-6 mb-2">
                                <label for="contact" class="label mb-1">{{ __('backend/default.contact') }}</label>
                                <div>
                                  <input type="text" class="form-control mb-2" name="contact" id="contact_{{ $row->id }}" value="{{ $row->contact }}" required>
                                </div>

                                <label for="district" class="label mb-1">{{ __('backend/default.district') }}</label>
                                <div class="mb-2">
                                  <select name="district_id" class="form-control mb-2 district" id="district_{{ $row->id }}" required>
                                    <option disabled="" selected="">-- Select District --</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}" {{ $row->district_id == $district->id ? 'selected':'' }}>{{ $district->name }}</option>
                                    @endforeach
                                  </select>
                                </div>

                                <label for="upazila" class="label mb-1">{{ __('backend/default.upazila') }}</label>
                                <div class="mb-2">
                                  <select name="upazila_id" class="form-control mb-2 upazila" id="upazila_{{ $row->id }}" required>
                                    <option disabled="" selected="">-- Select Upazila --</option>
                                    @foreach($upazilas as $upazila)
                                    <option  class="{{ '_'.$upazila->district_id }}" style="{{ $upazila->district_id == $row->district_id ? '':'display: none' }};" value="{{ $upazila->id }}" {{-- $row->upazila_id == $upazila->id ? 'selected':'' --}}>{{ $upazila->name }}</option>
                                    @endforeach
                                  </select>
                                </div>

                                <label for="location" class="label mb-1">{{ __('backend/default.address') }}</label>
                                <div>
                                  <textarea style="height: 107px;" class="form-control mb-2" name="location" id="location" required>{{ $row->location }}</textarea>
                                </div>
                              </div>
                            </div>
                            
                            <div class="button-group pull-right">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('backend/default.close') }}</button>
                              <button type="submit" class="btn btn-primary">{{ __('backend/default.update') }}</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @else
                  <div class="btn-group">
                    <button title="Can't Edit" class="btn text-white btn-secondary disabled" onClick="alert('You can\'t edit other\'s wish!')" role="button" disabled><i class="fa fa-edit"></i></button>
                    <button title="Can't Delete" class="btn text-white btn-secondary disabled" onClick="alert('You can\'t delete other\'s wish!')" role="button" disabled><i class="fa fa-trash"></i></button>
                  </div>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- sending `$rows` and it'll be received by `$table` --}}
        <!-- Paginaiton -->
        @include('backend.partials.pagination', ['table' => $rows])

      </div>
    </div>
  </div>
</div>
<!-- Add Modal -->
<div class="modal fade" id="add_new" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel"><i class="fa fa-plus-square"></i> {{ __('backend/default.add_wish_list') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.wish_list.store') }}" method="POST">
          @csrf

          <div class="form-row">
            <div class="col-6 text-left">
              <label for="title" class="label mb-1">{{ __('backend/default.title') }}</label>
              <div>
                <input type="text" class="form-control mb-2" value="{{ old('title') }}" name="title" id="title" required>
              </div>

              <label for="writer" class="label mb-1">{{ __('backend/default.writer') }} </label>
              <div>
                <input type="text" class="form-control mb-2" value="{{ old('writer') }}" name="writer" id="writer">
              </div>
              <label for="edition" class="label mb-1">{{ __('backend/default.edition') }}</label>
              <div>
                <input type="text" class="form-control mb-2" value="{{ old('edition') }}" name="edition" id="edition">
              </div>
              <label for="grade" class="label mb-1">{{ __('backend/default.grade') }}</label>
              <div>
                <select value="{{ old('grade') }}" name="grade" class="form-control mb-2" id="grade" required>
                  <option disabled="" selected="">-- Select Grade --</option>
                  <option value='5'>Higher Education (Hons./MS/PhD)</option>
                  <option value='4'>Higher Secondary (11-12)</option>
                  <option value='3'>Secondary (9-10)</option>
                  <option value='2'>Lower Secondary (6-8)</option>
                  <option value='1'>Primary (1-5)</option>
                </select>
              </div>
              <label for="cost" class="label mb-1">{{ __('backend/default.cost') }}</label>
              <div>
                <input type="number" class="form-control mb-2" value="{{ old('cost') }}" name="cost" id="cost" value="0" required>
              </div>
            </div>
            <div class="col-6 mb-2">
              <label for="contact" class="label mb-1">{{ __('backend/default.contact') }}</label>
              <div>
                <input type="text" class="form-control mb-2" name="contact" id="contact" value="{{ !empty(old('contact')) ? old('contact') : Auth::guard('admin')->user()->mobile }}" required>
              </div>

              <label for="district" class="label mb-1">{{ __('backend/default.district') }}</label>
              <div class="mb-2">
                <select name="district_id" class="form-control mb-2" id="district" required>
                  <option disabled="" selected="">-- Select District --</option>
                  @foreach($districts as $district)
                  <option value='{{ $district->id }}'>{{ $district->name }}</option>
                  @endforeach
                </select>
              </div>

              <label for="upazila" class="label mb-1">{{ __('backend/default.upazila') }}</label>
              <div class="mb-2">
                <select name="upazila_id" disabled="" class="form-control mb-2" id="upazila" required>
                  <option disabled="" selected="">-- Select Upazila --</option>
                  @foreach($upazilas as $upazila)
                  <option  class="{{ '_'.$upazila->district_id }}" style="display: none;" value='{{ $upazila->id }}'>{{ $upazila->name }}</option>
                  @endforeach
                </select>
              </div>

              <label for="location" class="label mb-1">{{ __('backend/default.address') }}</label>
              <div>
                <textarea style="height: 107px;" class="form-control mb-2" name="location" id="location" required></textarea>
              </div>
            </div>
          </div>

          <div class="button-group pull-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('backend/default.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('backend/default.submit') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- View Modal -->
<div class="modal fade" id="this_view" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel"><i class="fa fa-eye"></i> {{ __('backend/default.view_wish_list') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- View Data --}}
      </div>
    </div>
  </div>
</div>
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')

  <script type="text/javascript">
    $(document).ready(function(){
      // $('#book_condition').select2();
      // $('#district').select2();
      // $('#upazila').select2();
      var district_id = '';
      $('#district').change(function(event) {

        $('#upazila').removeAttr('disabled');
        district_id = $(this).val();
        $('.'+'_'+district_id).siblings().hide();
        $('.'+'_'+district_id).show();
      });

      district_id = '';
      $('.district').change(function(event) {

        $(this).closest('form').find('.upazila').removeAttr('disabled');
        district_id = $(this).val();
        // $(this).closest('form').find('.upazila').find('option').removeAttr('selected');
        $(this).closest('form').find('.'+'_'+district_id).siblings().hide();
        $(this).closest('form').find('.'+'_'+district_id).show();
        $(this).closest('form').find('.'+'_'+district_id+':first-child').attr('selected', 'selected');
      });
    });
  </script>
  <script>
  function upload_check()
  {
    var photo = document.getElementById("photo");
    // alert(photo.files[0].size > 2*1024*1024);
    var max = 2*1024*1024;

    if(photo.files[0].size > max)
    {
       alert("File too big!");
       photo.value = "";
    }
  };
  </script>
@endsection