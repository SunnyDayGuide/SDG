@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2 mr-4">Catagories</h1>
<a class="btn btn-primary" href="{{ route('admin.categories.create') }}" role="button">New Category</a>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12 table-responsive9">
			<table class="table">
				<thead class="thead-light">
					<th>#</th>
					<th>Name</th>
					<th>Slug</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($categories as $category)
						<tr>
							<td>{{ $category->id }}</td>
							<td>{{ $category->name }}</td>
							<td>{{ $category->slug }}</td>
							<td align="right">
								<a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-secondary">Edit</a>
								<div class="d-inline-block">
									<form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
										@method('DELETE')
									    @csrf
									    <input type="submit" class="btn btn-sm btn-secondary" value="Delete">
									</form>
								</div>
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div> <!-- end col -->
	</div> <!-- end row -->
@endsection