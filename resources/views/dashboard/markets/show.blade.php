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

	</div>

@endsection
