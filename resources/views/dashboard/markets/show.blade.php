@extends('layouts.dashboard')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>{{ $market->name }} / {{ $market->code }}</h1>
			</div>
			<div class="col-md-3 offset-md-1">
				<a href="{{ route('dashboard.markets.edit', $market->id) }}" class="btn btn-primary btn-block btn-lg">Edit Market</a>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-8">
				<p><strong>Slug:</strong> {{ $market->slug }}/</p>
				<p><strong>Alternate Name:</strong> {{ $market->name_alt ?: 'None' }}</p>
				<p><strong>State:</strong> {{ $market->state->name }}</p>
				<p><strong>Associated Cities:</strong> {{ $market->cities ?: 'None' }}</p>
				<p><strong>Sunny Day Brand:</strong> {{ $market->brand->name }}</p>
			</div>

			<div class="col-md-3 offset-md-1">
				<div class="card">
					<h5 class="card-header bg-secondary text-white">Update Category</h5>
					<div class="list-group list-group-flush">
						@foreach ($categories as $category)
						<a href="/dashboard/markets/{{ $market->id }}/category/{{ $category->id }}/edit" class="list-group-item list-group-item-action">{{ $category->name }}</a>
						@endforeach
					</div>
				</div>
			</div>
		</div> <!-- End Row -->

		<hr>

		<div class="row">
			<div class="col-md-12">
				<h2>Market Categories</h2>
				<table class="table">
					<thead class="thead-light">
						<th>#</th>
						<th>Name</th>
						<th>Page Title</th>
						<th></th>
					</thead>
					<tbody>
						@foreach ($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>{{ $category->name }}</td>
								<td>{{ $category->pivot->title }}</td>
								<td align="right">
									<a href="{{ route('dashboard.marketCategory.edit', [$market->id, $category->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
									<div class="d-inline-block">
										<form action="{{ route('dashboard.marketCategory.destroy', [$market->id, $category->id]) }}" method="POST">
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
				<a href="{{ route('dashboard.marketCategory.create', $market->id) }}" class="btn btn-lg btn-primary btn-h1-spacing">Add a Market Category</a>
			</div> <!-- end col -->
			
		</div> <!-- End Row -->

	</div>

@endsection
