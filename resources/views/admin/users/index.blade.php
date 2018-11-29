@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2 mr-4">Users</h1>
<a class="btn btn-primary" href="{{ route('admin.users.create') }}" role="button">New User</a>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12 table-responsive9">
			<table class="table">
				<thead class="thead-light">
					<th>Name</th>
					<th>Email</th>
					<th>Department(s)</th>
					<th>Market(s)</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>
								@if ($user->departments->count())
									@foreach ($user->departments as $department)
									{{ $department->name }}{{ $loop->last ? '' : ', ' }}
									@endforeach
								@endif
							</td>
							<td>
								@if ($user->markets->count())
									@foreach ($user->markets as $userMarket)
									{{ $userMarket->code }}{{ $loop->last ? '' : ', ' }}
									@endforeach
								@endif
							</td>
							<td align="right">
								<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-secondary">Edit</a>
								<div class="d-inline-block">
									<form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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