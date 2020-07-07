@extends('backend.layouts.master')

@section('fav_title', __('backend/module.module') )

@section('styles')
<style>
	textarea {
		white-space: pre;
	}
</style>
@endsection

@section('content')
<div class="app-title">
	<div>
		<h1><i class="{{ 'fa fa-puzzle-piece' }}"></i> {{ __('backend/module.module_management') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
		<li class="breadcrumb-item active">{{ __('backend/module.module') }}</li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-header">
				<div class="row">
					<div class="col-md-6"><h2><i class="{{ 'fa fa-table' }}"></i> {{ __('backend/module.module_list') }}</h2></div>
					<div class="col-md-6 btn-group justify-content-end">
		                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModule">
						  {{ __('backend/module.add_module') }}
						</button>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="card-body" data-my-table="table-1">
				<div class="d-flex">
					<div class="toggle-table-column alert-info p-2 mb-2 col-sm-10 rounded-left">
						<strong>{{ __('backend/default.table_toggle_message') }} </strong>

						<a href="#" class="toggle-vis" data-column="0"><b>{{ __('backend/default.sl') }}</b></a> |
						<a href="#" class="toggle-vis hide-on-load" data-column="1"><b>{{ __('backend/default.date') }}</b></a> |
						<a href="#" class="toggle-vis hide-on-load" data-column="2"><b>{{ __('backend/default.name') }}</b></a> |
						<a href="#" class="toggle-vis" data-column="3"><b>{{ __('backend/default.title') }}</b></a> |
						<a href="#" class="toggle-vis" data-column="4"><b>{{ __('backend/default.tag') }}</b></a> |
						<a href="#" class="toggle-vis" data-column="5"><b>{{ __('backend/default.action') }}</b></a>

					</div>
					<div class="toggle-table-column alert-secondary p-2 mb-2 col-sm-2 rounded-right text-right" id="active-tag-container">
						<span id="active-tag" title="Click to reset!" class="badge badge-secondary cursor-pointer px-2 py-1" style="padding-bottom: 7px !important;"></span>
					</div>
				</div>
				<div class="table-responsive pt-1">

					{{-- Search and Select --}}
					{{-- @include('backend.partials.pagination_page_numbering', ['route' => Route::currentRouteName(), 'items' => $items, 'total' => $total, ]) --}}

					<table id="datatable" class="table table-bordered table-hover rounded display">

						<thead>
							<th>{{ __('backend/default.sl') }}</th>
							<th>{{ __('backend/default.date') }}</th>
							<th>{{ __('backend/default.name') }}</th>
							<th>{{ __('backend/default.title') }}</th>
							<th>{{ __('backend/default.tag') }}</th>
							<th class="action">{{ __('backend/default.action') }}</th>
						</thead>
						<tbody>
							@php
								$tags = \App\Models\ModuleTag::orderBy('tag')->select(['id', 'tag'])->get()->keyBy('id')->toArray();
							@endphp
							@foreach ($rows as $row)
							<tr class="{{ $row->status == 0 ? 'inactive_':'' }}">
								<td width="20">{{ $loop->index+1 }}</td>
								<td>{{ $row->created_at->diffForHumans() }}</td>
								<td>{{ $row->admin->name }}</td>
								<td>{{ $row->title }}</td>
								<td class="tag-container-tr">

									@foreach(json_decode($row->module_tag_id) as $tag)
										<span class="module_tag badge alert-primary font-weight-normal cursor-pointer mr-1" data-class_="{{ $tags[$tag]['tag'] }}">{{ $tags[$tag]['tag'] }}</span>
									@endforeach
								</td>
								<td class="action" width="100">
									<div class="btn-group">
										<button class="btn btn-info viewModal" data-toggle="modal" data-target="#viewModule" id="module_{{ $row->id }}"><i class="fa fa-eye"></i></button>
										<button class="btn btn-warning editModal" data-toggle="modal" data-target="#editModule" id="module_edit_{{ $row->id }}"><i class="fa fa-edit"></i></button>
										<button class="btn text-white {{ $row->status == 0 ? ' btn-secondary disabled':' btn-danger' }}" onClick="deleteMethod({{ $row->id }})" {{ $row->status == 0 ? 'disabled':'' }}><i class="fa fa-trash"></i></button>
									</div>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>

				</div>
				{{-- sending `$rows` and it'll be received by `$table` --}}
				{{-- @include('backend.partials.pagination', ['table' => $rows]) --}}
				
			</div>
		</div>
		<!-- Add Modal -->
		<div class="modal fade" id="addModule" tabindex="-1" role="dialog" aria-labelledby="addModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      	<form action="{{ route('admin.module.store') }}" method="POST" enctype="multipart/form-data">
				  @csrf
			      <div class="modal-header">
			        <h5 class="modal-title" id="addTitle">Add Module</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
		      		<div class="form-group">
		      			<label for="title">Title</label>
		      			<input class="form-control" type="text" id="title" name="title" required="">
		      		</div>
		      		<div class="form-group">
		      			<label for="description">Description</label>
		      			<textarea style="height: 250px;" class="form-control" id="description" name="description" required=""></textarea>
		      		</div>
		      		<div class="form-group">
		      			<label for="tags">Tags</label>
		      			<input class="form-control" type="text" id="tags" name="tags" required="" placeholder="<tag1>,<tag2>,..">
		      		</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Save changes</button>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>
		<!-- View Modal -->
		<div class="modal fade" id="viewModule" tabindex="-1" role="dialog" aria-labelledby="viewTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="viewTitle">View Module <i class="fa fa-spinner fa-spin" style="display: none;" id="getDescription"></i></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body position-relative">
		      	<h4 id="module-title"></h4>
		      	<textarea class="form-control" id="module-description" style="height: 300px;" readonly=""></textarea>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      	<span class="btn alert-info copy-button"><i class="fa fa-copy"></i> Click to copy</span>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Edit Modal -->
		<div class="modal fade" id="editModule" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      	<form id="edit-form" action="{{ route('admin.module.update', '') }}" method="POST" enctype="multipart/form-data">
				  @csrf
			      <div class="modal-header">
			        <h5 class="modal-title" id="editTitle">Edit Module <i class="fa fa-spinner fa-spin" style="display: none;" id="editDescription"></i></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body position-relative">
		      		<div class="form-group">
		      			<label for="title">Title</label>
		      			<input class="form-control" type="text" id="edit-module-title" name="title" required="">
		      		</div>
		      		<div class="form-group">
		      			<label for="description">Description</label>
		      			<textarea style="height: 250px;" class="form-control" id="edit-module-description" name="description" required=""></textarea>
		      		</div>
		      		<div class="form-group">
		      			<label for="tags">Tags</label>
		      			<input class="form-control" type="text" id="edit-module-tags" name="tags" required="" placeholder="<tag1>,<tag2>,..">
		      		</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Save changes</button>
			      </div>
			 	</form>
		    </div>
		  </div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		var edit_url = $('#edit-form').attr('action');

		$('.editModal').click(function(){

			$('#edit-module-title').val(' ');
			$('#edit-module-description').text(' ');
			$('#edit-module-tags').val(' ');

			$('#editDescription').show();
			var id = $(this).attr('id').match(/\d/g).join("");
			var url = "{{ route('admin.module.get_description') }}";
			var data = {
				id: id,
				_token: "{{ csrf_token() }}"
			};

			$.post(url, data, function(data, status){
				var response = jQuery.parseJSON(data);

				var tag_url = "{{ route('admin.module.get_tegs') }}";
				var teg_data = {
					id: response.module_tag_id,
					_token: "{{ csrf_token() }}",
				};
				$.post(tag_url, teg_data, function(data, status){
					var response2 = jQuery.parseJSON(data);

					$('#editDescription').fadeOut('');
					$('#edit-module-title').val(response.title);
					$('#edit-module-description').text(response.description);
					$('#edit-module-tags').val(response2);

					$('#edit-form').attr('action', edit_url+'/'+id);
				});
			});
		});
		$('.viewModal').click(function(){
			$('#module-title').text('');
			$('#module-description').text('');

			$('#getDescription').show();
			var id = $(this).attr('id').match(/\d/g).join("");
			var url = "{{ route('admin.module.get_description') }}";
			var data = {
				id: id,
				_token: "{{ csrf_token() }}"
			};

			$.post(url, data, function(data, status){
				var response = jQuery.parseJSON(data);

				$('#getDescription').fadeOut('');
				$('#module-title').text(response.title);
				$('#module-description').text(response.description);
			});
		});
		$(".copy-button").click(function(){
		    $("#module-description").select();
		    document.execCommand('copy');
		    toastr["success"]("Copied to clipboard!");
		});

		$('.module_tag').click(function(){
			var dataClass = $(this).data('class_');
			$(this).closest('table').find('.container_tr').removeClass('container_tr');
			$(this).closest('table').find('tbody').find('tr').hide();
			$(this).closest('tr').addClass('container_tr');
			$(this).closest('table').find('span[data-class_='+dataClass+']').closest('tr').fadeIn('fast');

			$('#active-tag').text(dataClass);
		});
		$('#active-tag').click(function(){
			$('.module_tag').closest('table').find('tbody').find('tr').fadeIn('fast');
			$(this).text('');
		});
	});
	var string = '';
	var fullHTML = '';
	$('.tag-container-tr').each(function(){
		$(this).children('span').each(function(){
			string += $(this).text()+',';
		});
		string = string.replace(/(^[,\s]+)|([,\s]+$)/g, '');
		string = string.split(",").sort();

		for (var i = 0; i < string.length; i++) {
			fullHTML += '<span class="module_tag badge alert-primary font-weight-normal cursor-pointer mr-1" data-class_="'+string[i]+'">#'+string[i]+'</span>';
		}

		$(this).html(fullHTML);

		string = '';
		fullHTML = '';
	});
</script>
@endsection