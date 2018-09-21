@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row mb-4">
		<div class="col-md-8">
			<h1>Markets Dashboard</h1>
		</div>

		<div class="col-md-3 offset-md-1">
			<a href="{{ route('dashboard.markets.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Market</a>
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
					@foreach ($markets as $market)
						<tr>
							<td>{{ $market->id }}</td>
							<td>{{ $market->name }}</td>
							<td>{{ $market->slug }}</td>
							<td>
								<a href="{{ route('dashboard.markets.show', $market->id) }}" class="btn btn-sm btn-secondary">View</a>
								<a href="{{ route('dashboard.markets.edit', $market->id) }}" class="btn btn-sm btn-secondary">Edit</a>
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection