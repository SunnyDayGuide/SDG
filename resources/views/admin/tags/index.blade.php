@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2 mr-4">Tags</h1>
<a class="btn btn-primary" href="{{ route('admin.tags.create') }}" role="button">New Tag</a>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12 table-responsive9">
			<table class="table">
				<thead class="thead-light">
					<th>Name</th>
					<th>Slug</th>
					<th>Tag Type</th>
					<th>Order</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($tags as $tag)
						<tr>
							<td>{{ $tag->name }}</td>
							<td>{{ $tag->slug }}</td>
							<td>
								@isset ($tag->type)
								{{ $tag->type }}
								@endisset
								</td>
							<td>{{ $tag->order_column }}</td>
							<td align="right">
								<a href="{{ route('admin.tags.edit', $tag->slug) }}" class="btn btn-sm btn-secondary">Edit</a>
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div> <!-- end col -->
	</div> <!-- end row -->
@endsection