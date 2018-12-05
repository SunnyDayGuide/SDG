@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2 mr-4">Freemail Types</h1>
<a class="btn btn-primary" href="{{ route('admin.freemail-types.create') }}" role="button">New Freemail Type</a>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12 table-responsive9">
			<table class="table">
				<thead class="thead-light">
					<th>Type Name</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($freemailTypes as $freemailType)
						<tr>
							<td>{{ $freemailType->name }}</td>
							<td align="right">

								<a href="{{ route('admin.freemail-types.edit', $freemailType->id) }}" class="btn btn-sm btn-secondary">Edit</a>

								<div class="d-inline-block">
									<form action="{{ route('admin.freemail-types.destroy', $freemailType->id) }}" method="POST">
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