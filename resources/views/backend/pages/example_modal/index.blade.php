<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/example_modal.example_modal') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
<!-- Top Management Part -->

<!--Remove from Comment {{--...--}} for Permission -->
<!-- Permission for Admin Access -->


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
    <h1><i class="{{ 'fa fa-circle-o' }}"></i> {{ __('backend/example_modal.example_modal') }} {{ __('backend/default.management') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('backend/example_modal.example_modal') }}</li>
  </ul>
</div>

<!-- Table Part -->
<div class="row">
  <div class="col-md-12">
    <div class="card">

      <div class="card-header">
        <div class="row">
          <div class="col-md-6"><h2><i class="{{ 'fa fa-circle-o' }}"></i> {{ __('backend/example_modal.example_modal_list') }}</h2></div>
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

          <!--<a></a>
          .
          .
          . 
          <a></a>-->

          {{-- 
            --add hide-on-load class to hide a table column on load --
           --}}
          <a href="#" class="toggle-vis" data-column="1"><b>{{ __('backend/default.title') }}</b></a> |
          <a href="#" class="toggle-vis hide-on-load" data-column="2"><b>{{ __('backend/default.status') }}</b></a> |
          <a href="#" class="toggle-vis" data-column="3"><b>{{ __('backend/default.action') }}</b></a>

        </div>

        <div class="table-responsive pt-1">
          <table {{-- id="my-table" --}} id="datatable" class="table table-bordered table-hover rounded display">

            <thead>
              <th>{{ __('backend/default.sl') }}</th>

              <!--<th></th>
              .
              .
              .
              <th></th>-->

              <th>{{ __('backend/default.title') }}</th>
              <th>{{ __('backend/default.status') }}</th>
              <th class="action">{{ __('backend/default.action') }}</th>
            </thead>

            <tbody>

              @foreach($rows as $row)
              @php($md5_id = md5($row->id))
              <tr class="{{ $row->status == 0 ? 'inactive_':'' }}">
                <td>{{ $loop->index + 1 }}</td>


                <!--<td></td>
                .
                .
                .
                <td></td>-->

                <td>{{ $row->title }}</td>
                <td>{{ $row->status == 1 ? 'Active' : 'Inactive' }}</td>
                <td class="action">
                  <div class="btn-group">
                    @foreach($permissions->submenus as $key => $permission)
                      @if(\App\Models\Menu::checkBodyMenu($permission->id, $myRole->in_body))
                        @if($key == 0)
                          <button title="View" data-toggle="modal" data-target="#view_page{{ encrypt($row->id) }}" class="btn btn-info text-white"><i class="fa fa-eye"></i></button>
                        @elseif($key == 1)
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
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square"></i> {{ __('backend/example_modal.example_modal') }} {{ __('backend/default.update') }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('admin.example_modal.update', encrypt($row->id)) }}" method="POST">
                            @csrf

                            <div class="form-group row">
                              <!--Inputs / TextAreas / Selects ... -->
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
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Add Modal -->
<div class="modal fade" id="add_new" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel"><i class="fa fa-plus-square"></i> {{ __('backend/example_modal.add_example_modal') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.example_modal.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label class="col-form-label" for="title">{{ __('backend/default.title') }}<span class="text-danger">*</span></label>
            <div>
              <input type="text" class="form-control" name="title" id="title" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-form-label" for="status">{{ __('backend/default.status') }} <span class="text-danger">*</span></label>
            <div>
              <select class="form-control" name="status" id="status" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
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
        <h5 class="modal-title" id="viewModalLabel"><i class="fa fa-eye"></i> {{ __('backend/example_modal.view_example_modal') }}</h5>
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
