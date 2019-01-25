@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2 mr-4">Freemail</h1>
<a class="btn btn-primary" href="{{ route('admin.freemails.create') }}" role="button">New Freemail Client</a>
<a class="btn btn-primary ml-2" href="{{ route('admin.freemail-types.index') }}" role="button">Manage Freemail Types</a>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12 table-responsive">
		<table class="table">
			<thead class="thead-light">
				<th width="5%">Market</th>
				<th width="25%">Client</th>
				<th>Type</th>
				<th>Sales Rep</th>
				<th>Status</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach ($freemails as $freemail)
				<tr>
					<td>{{ $freemail->market->code }}</td>
					<td>{{ $freemail->client }}</td>
					<td>{{ $freemail->freemail_type->name }}</td>
					<td>{{ $freemail->employee->name }}</td>
					<td>Status</td>
					<td>
						<a href="{{ route('admin.freemails.show', $freemail->id) }}" class="btn btn-sm btn-secondary">View</a>

						<a href="{{ route('admin.freemails.edit', $freemail->id) }}" class="btn btn-sm btn-secondary">Edit</a>

						<form action="{{ route('admin.freemails.destroy', $freemail->id) }}" method="POST">
							@method('DELETE')
						    @csrf
						    <button type="submit" class="btn btn-sm btn-danger" value="Delete"><i class="far fa-trash-alt"></i></button>
						</form>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

		{{ $freemails->links() }}

	</div>
	<div class="col">

	</div>

</div> <!-- end of row -->

@endsection