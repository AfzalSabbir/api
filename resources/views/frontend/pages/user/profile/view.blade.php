<!-- Full Structure -->
@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.profile'))

<!-- Write Styles <style>In Here</style> -->
@section('styles')
@endsection

<!-- This Section Will Shown <body>In Here</body> -->
@section('content')
	@include('frontend.partials.profile.profile_banner')
	@include('frontend.partials.profile.profile_nav')
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				@include('frontend.partials.profile.book_sidebar')
            	@include('frontend.partials.profile.profile_setting_sidebar')
            	@php
            		$admin_id = \Auth::guard('admin')->user()->id;

            		$books 			= \App\Models\Book::where('admin_id', $admin_id)->withTrashed()->get();
            		$total_wishes 	= \App\Models\WishList::where('admin_id', $admin_id)->get()->count();

            		$ids = [];

            		$total = $total_donation = $total_sale = $total_left = $total_comments =
            		$total_commented = $total_bells = $total_belled = $total_reported_book =
            		$total_removed_book = $total_visits = 0;

            		foreach ($books as $key => $value) {
            			if ($value->deleted_at == NULL) {
            				$total += 1;
	            			$ids[] = $value->id;

	            			if ($value->taken_by_id > 0 && (int)$value->cost > 0) $total_sale += 1;
	            			if ($value->taken_by_id > 0 && (int)$value->cost == 0) $total_donation += 1;
	            			if ($value->taken_by_id == NULL) $total_left += 1;
            			}
            			else{
            				$total_removed_book += 1;
	            			// if ($value->taken_by_id > 0 && (int)$value->cost > 0) $total_donation += 1;
	            			// if ($value->taken_by_id > 0 && (int)$value->cost == 0) $total_sale += 1;
            			}
            		}


            		$total_comments = \App\Models\BookComment::whereIn('book_id', $ids)->get()->count();
            		$total_commented = \App\Models\BookComment::where('admin_id', $admin_id)->get()->count();

            		$total_bells = \App\Models\BookAcceptHistory::whereIn('book_id', $ids)->get()->count();
            		$total_belled = \App\Models\BookAcceptHistory::where('admin_id', $admin_id)->get()->count();

            		$total_reported_book = \App\Models\BookReport::whereIn('book_id', $ids)->get()->count();

            		$total_visits = \App\Models\BookVisit::whereIn('book_id', $ids)->get()->count();

            	@endphp
			</div>
			<div class="col-lg-6">
				<table class="table table-inverse table-striped">
					<tbody>
						<tr>
							<th class="py-2">Total Posted Books</th>
							<th class="py-2">: </th>
							<th class="py-2 text-right">{{ $total + $total_removed_book }}</th>
						</tr>
						<tr>
							<th class="py-2 text-primary">Total Active Books</th>
							<th class="py-2 text-primary">: </th>
							<th class="py-2 text-primary text-right">{{ $total }}</th>
						</tr>
						<tr>
							<td class="py-2 text-danger">Total Removed Book</td>
							<td class="py-2 text-danger">: </td>
							<td class="py-2 text-danger text-right">{{ $total_removed_book }}</td>
						</tr>
						<tr>
							<th class="py-2 text-orange">Total Left</th>
							<th class="py-2 text-orange">: </th>
							<th class="py-2 text-orange text-right">{{ $total_left }}</th>
						</tr>
						<tr>
							<th class="py-2 text-success">Total Donations</th>
							<th class="py-2 text-success">: </th>
							<th class="py-2 text-success text-right">{{ $total_donation }}</th>
						</tr>
						<tr>
							<td class="py-2 text-info">Total Sells</td>
							<td class="py-2 text-info">: </td>
							<td class="py-2 text-info text-right">{{ $total_sale }}</td>
						</tr>
						<tr>
							<td class="py-2">Total Wishes</td>
							<td class="py-2">: </td>
							<td class="py-2 text-right">{{ $total_wishes }}</td>
						</tr>
						<tr>
							<td class="py-2">Total Comments</td>
							<td class="py-2">: </td>
							<td class="py-2 text-right">{{ $total_comments }}</td>
						</tr>
						<tr>
							<td class="py-2">Total Commented</td>
							<td class="py-2">: </td>
							<td class="py-2 text-right">{{ $total_commented }}</td>
						</tr>
						<tr>
							<td class="py-2">Total Bells</td>
							<td class="py-2">: </td>
							<td class="py-2 text-right">{{ $total_bells }}</td>
						</tr>
						<tr>
							<td class="py-2">Total Belled</td>
							<td class="py-2">: </td>
							<td class="py-2 text-right">{{ $total_belled }}</td>
						</tr>
						<tr>
							<td class="py-2">Total Reported Book</td>
							<td class="py-2">: </td>
							<td class="py-2 text-right">{{ $total_reported_book }}</td>
						</tr>
						<tr>
							<td class="py-2">Total Visits</td>
							<td class="py-2">: </td>
							<td class="py-2 text-right">{{ $total_visits }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Write Scripts <script fileType="text/javascript">In Here</script> -->
@section('scripts')
@endsection