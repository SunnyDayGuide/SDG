@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="row mb-4">
		<div class="col-md-8">
			<h1>Catgories Dashboard</h1>
		</div>

		<div class="col-md-3 offset-md-1">
			<a href="{{ route('admin.categories.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Category</a>
		</div>

	</div> <!-- end of .row -->

	<div class="row">
		<div class="col-md-12">
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
</div> <!-- end container -->
@endsection