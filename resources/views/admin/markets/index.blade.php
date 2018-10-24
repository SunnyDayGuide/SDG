@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Markets Dashboard</h1>
@endsection

@section('content')
<div class="container">
	<div class="row mb-3">
		<div class="col-md-12 table-responsive">
			<table class="table">
				
				<thead class="thead-light">
					<th>#</th>
					<th>Name</th>
					<th>Slug</th>
					<th># Categories</th>
					<th></th>
				</thead>

				<tbody>
					@foreach ($markets as $market)
						<tr>
							<td>{{ $market->id }}</td>
							<td>{{ $market->name }}</td>
							<td>{{ $market->slug }}</td>
							<td>{{ count($market->categories) }}</td>
							<td align="right">
								{{-- <a href="{{ route('dashboard.markets.show', $market->id) }}" class="btn btn-sm btn-secondary">View</a> --}}
								<a href="{{ route('admin.markets.edit', $market->id) }}" class="btn btn-sm btn-secondary">Edit</a>

								<div class="d-inline-block">
									<form action="{{ route('admin.markets.destroy', $market->id) }}" method="POST">
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

	<div class="row">
		<div class="col-md-3 offset-md-9">
			<a href="{{ route('admin.markets.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New Market</a>
		</div>
	</div> <!-- end of .row -->

	<h4 class="text-danger">Cannot delete a market until I resolve cascade or softDelete situation</h4>
	<h5><a href="https://medium.com/asked-io/cascading-softdeletes-with-laravel-5-a1a9335a5b4d" class="text-danger">Check out this solution</h5>

</div> <!-- end container -->
@endsection