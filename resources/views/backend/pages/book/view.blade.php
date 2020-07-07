<!-- Full Structure -->
@extends('backend.layouts.master')

@section('fav_title', $row->title )

<!-- Write Styles <style>In Here</style> -->
@section('styles')
<style>
	.img-comment {
		height: 25px;
		padding-right: 8px;
		border-radius: 4px;
	}
</style>
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
<!-- Top Management Part -->
<div class="app-title">
	<div>
		<h1><i class="{{ 'fa fa-book' }}"></i> {{ __('backend/book.book_management') }}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.book.index') }}">{{ __('backend/book.book') }}</a></li>
		<li class="breadcrumb-item active">{{ __('backend/default.view') }}</li>
	</ul>
</div>

<!-- Table Part -->
@if($row->status != 9)
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-header">
				<div class="row">
					{{-- <div class="col-md-6"><h2><i class="{{ 'fa fa-eye' }}"></i> {{ __('backend/book.view_book') }}</h2></div> --}}
					<div class="col-md-6"><h2><i class="{{ 'fa fa-book' }}"></i> {{ $row->title }}</h2></div>
					@if($row->admin_id == \Auth::guard('admin')->user()->id)
						<div class="col-md-6">
							<div class="btn-group float-right">
								{{-- <a href="{{ route('admin.book.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{ __('backend/default.list') }}</a> --}}
								<a href="{{ route('admin.book.edit', encrypt($row->id)) }}" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="{{ __('backend/default.edit') }}"><i class="fa fa-pencil"></i></a>
							</div>
						</div>
					@else
						<div class="col-md-6">
							<div class="btn-group float-right">
                               	<button
                               		class="btn {{ $row->admin_id != Auth::guard('admin')->user()->id ? ($row->taken_by_id > 0 ? 'btn-success disabled':'btn-success'):'btn-secondary disabled' }}" data-toggle="tooltip" data-html="true" title="{{ __('backend/default.i_want_it') }}"
									@if(!($row->taken_by_id > 0))
                               			onClick="acceptMethod({{ json_encode(encrypt($row->id)) }})"
                               		@endif
                               		role="button" {{ \App\Models\BookAcceptHistory::where('admin_id', Auth::guard('admin')->user()->id)->where('book_id', $row->id)->first() ? 'disabled':'' }}>
                               		<i class="fa fa-check"></i>
                               	</button>
							</div>
						</div>
					@endif
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="card-body col-12 col-lg-6 offset-lg-2 p-0">
				<div class="table-responsive">
					<table class="table table-bordered display table-striped">
						<tbody>
							<tr>
								<td style="width: 30px;">
									<strong>{{ __('backend/default.title') }} </strong>
								</td>
								<td>
									<span class="monospace-inconsolata">
										<span class="h5">{{ $row->title }}</span>
										<br>
										{!! strlen($row->edition) > 0 ? '<kbd>'.$row->edition.' Edition</kbd>':'' !!} 
										<kbd><i>[{{ num2locale($row->visits).' '.__('backend/default.view') }}]</i></kbd>
										<kbd class="monospace-inconsolata {{ $row->status == 1 ? 'bg-success' : 'bg-danger' }}">{{ $row->status == 1 ? __('backend/default.available') : __('backend/default.taken') }}</kbd>
										<br>
										{{ num2locale($row->created_at->diffForHumans()) }}

									</span>
								</td>
							</tr>
							<tr>
								<td>
									<strong>{{ __('backend/default.photo') }}{{-- <small><sub>(s)</sub></small> --}} </strong>
								</td>
								<td>
									<img class="monospace-inconsolata" style="width: 200px;" src="{{ asset($row->photo) }}">
								</td>
							</tr>
                            <tr>
                            	<td>
                            		<strong>{{ __('backend/default.writer') }} </strong>
                            	</td>
                            	<td>
									<span class="monospace-inconsolata">
										@foreach(explode(";", $row->writer) as $writer)
									 		- {{ trim($writer) }}<br>
									 	@endforeach
									</span>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<strong>{{ __('backend/default.condition') }} </strong>
                            	</td>
                            	<td>
									<span class="monospace-inconsolata">
										@if($row->book_condition == 2)
											<i class="fa fa-star text-warning"></i>
											<i class="fa fa-star text-warning"></i>
											<i class="fa fa-star text-secondary"></i> <i>[Good]</i>
										@elseif($row->book_condition == 3)
											<i class="fa fa-star text-warning"></i>
											<i class="fa fa-star text-warning"></i>
											<i class="fa fa-star text-warning"></i> <i>[New]</i>
										@else
											<i class="fa fa-star text-warning"></i>
											<i class="fa fa-star text-secondary"></i>
											<i class="fa fa-star text-secondary"></i> <i>[Poor]</i>
										@endif
									</span>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<strong>{{ __('backend/default.location') }} </strong>
                            	</td>
                            	<td>
									<span class="monospace-inconsolata">
										{{ $row->district['name'] }},
										{{ $row->upazila['name'] }}
										<br>
										{{ $row->location }}
									</span>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<strong>{{ __('backend/default.price') }} </strong>
                            	</td>
                            	<td>
									<span class="monospace-inconsolata">{{ num2locale((int)$row->cost>0? $row->cost:'Free') }}</span>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<strong>{{ __('backend/default.contact') }} </strong>
                            	</td>
                            	<td>
									<span class="monospace-inconsolata">{{ num2locale($row->contact) }}</span>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		<strong>{{ __('backend/default.post') }} </strong>
                            	</td>
                            	<td>
									<span class="monospace-inconsolata">{{ $row->admin->name }}</span>
                            	</td>
                            </tr>
                            @if($row->admin_id == \Auth::guard('admin')->user()->id)
                                <tr>
                                	<td>
                                		<strong>{{ __('backend/default.asked') }} </strong>
                                	</td>
                                	<td>
                                		@if(count($row->who_asked) > 0)
	                                		@foreach($row->who_asked as $person)
	                                			@php
	                                				$asked_person = \App\Models\Admin::where('id', $person->admin_id)->first();
	                                			@endphp
												<strong
													@if($row->status != 2)
													onClick="
														confirmAcceptMethod({{ json_encode(encrypt($row->id)).', '.json_encode($asked_person->mobile).', '.json_encode(base64_encode(rand(111100, 999900).$asked_person->id)) }})"
													@endif
													data-toggle="tooltip" data-html="true" title="{{ $asked_person->mobile }}"
													style="color: var(--nav-primary); cursor: pointer; line-height: 50px; white-space: nowrap;"
													id="admin_id_{{ $person->admin_id }}"
													class="monospace-inconsolata h6 admin_id_x px-1 py-0 mb-0 alert {{ $row->taken_by_id > 0 ? 'cursor-default':'cursor-pointer' }} {{ $row->taken_by_id == $asked_person->id ? 'alert-success border-success':'alert-warning border-warning' }}"
												>{{ $asked_person->name }}</strong>{{-- $loop->index < count($row->who_asked) - 1? ', ':'' --}}
	                                		@endforeach
	                                	@else
	                                		<code class="alert alert-danger">None Asked Yet!</code>
                                		@endif
                                	</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
	            <comment
	            	@php
	            		$local = [
	            			'comment' => __('backend/default.comment'),
	            			'write_comment' => __('backend/default.write_comment'),
	            		];
	            	@endphp
		            url 		= "{{ json_encode(route('admin.book.comment', encrypt($row->id))) }}"
		            post_url	= "{{ route('admin.book.axios_comment', encrypt($row->id)) }}"
		            book_id		= "{{ encrypt($row->id) }}"
		            book_detail	= "{{ json_encode($row) }}"
		            comments	= "{{ json_encode($comments) }}"
	            >
	        		@csrf
	    		</comment>
            </div>
        </div>
    </div>
</div>
@else
<div class="card-body">
	<div class="col-sm-12 p-0">
		<h3 class="alert alert-info my-5 py-5"><i class="fa fa-info-circle"></i> <code>This link is broken or you are trying to access a deleted item!</code></h3>
	</div>
</div>
@endif
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		// $('.admin_id_x').on('click', function(event) {
		// 	$(this).hide();
		// 	swal('hi');
		// 	event.preventDefault();
		// });
		$(function(){
			$('textarea[name=comment_body]').avro({
				'bangla':{{ Session::get('locale') == 'bn' ? 'true':'false' }}
			});
		});
	});
</script>
@endsection