<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', __('backend/example.view_example') )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
<!-- Top Management Part -->
<div class="app-title">
	<div>
		<h1><i class="{{ 'fa fa-dot-circle-o' }}"></i> {{ __('backend/example.example_management') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.example.index') }}">{{ __('backend/example.example') }}</a></li>
		<li class="breadcrumb-item active">{{ __('backend/default.view') }}</li>
	</ul>
</div>

<!-- Table Part -->
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-header">
				<div class="row">
					<div class="col-md-6"><h2><i class="{{ 'fa fa-eye' }}"></i> {{ __('backend/example.view_example') }}</h2></div>
					{{-- <div class="col-md-6">
						<div class="btn-group float-right">
							<a href="{{ route('admin.example.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ __('backend/default.list') }}</a><a href="{{ route('admin.example.edit',$row->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> {{ __('backend/default.edit') }}</a>
						</div>
					</div> --}}
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="card-body">

				<div class="">
					<div class="table-responsive">
						<table class="table table-bordered display table-striped">
							<tbody>
								<tr>
									<td>
										<strong>Title: </strong>
									</td>
									{{-- <td>
										<span class="monospace-inconsolata">{{ $row->title }}</span>
									</td> --}}
								</tr>
								<tr>
									<td>
										<strong>Photo<small><sub>(s)</sub></small>: </strong>
									</td>
									{{-- <td>
										@foreach($row->image as $image)
										<img class="monospace-inconsolata" style="width: 200px;" src="{{ asset($image) }}">
										@endforeach
									</td> --}}
								</tr>
                                <tr>
                                	<td>
                                		<strong>Status: </strong>
                                	</td>
                                	{{-- <td>
                                		<span class="monospace-inconsolata">{{ $row->status == 1 ? 'Active' : 'Inactive' }}</span>
                                	</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
    @section('scripts')
    @endsection