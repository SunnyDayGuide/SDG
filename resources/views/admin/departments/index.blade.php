@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2 mr-4">Departments</h1>
<a class="btn btn-primary" href="{{ route('admin.departments.create') }}" role="button">New Department</a>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12 table-responsive9">
			<table class="table">
				<thead class="thead-light">
					<th>Department Name</th>
					<th># of Employees</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($departments as $department)
						<tr>
							<td>{{ $department->name }}</td>
							<td>{{ count($department->users) }}</td>
							<td align="right">
								<a href="{{ route('admin.departments.show', $department->id) }}" class="btn btn-sm btn-secondary">View</a>
								<a href="{{ route('admin.departments.edit', $department->id) }}" class="btn btn-sm btn-secondary">Edit</a>
								<div class="d-inline-block">
									<form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST">
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