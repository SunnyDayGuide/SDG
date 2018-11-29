@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Add a Department</h1>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<form method="POST" action="{{ route('admin.departments.store') }}">
			{{ csrf_field() }}

				<div class="form-group">
					<label for="name">Department Name:</label>
		            <input type="text" class="form-control" id="name" name="name"
		               value="{{ old('name') }}" required>
				</div>

				<div class="form-group">
					<label for="manager_id">Manager</label>
					<select class="form-control" name="manager_id">
						<option value="">Select Manager</option>
						@foreach($employees->sortBy('name') as $employee)
							<option value='{{ $employee->id }}'>{{ $employee->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg">Add Department</button>
				</div>

			</form>

			@include ('partials._messages')
			
		</div>
	</div>
</div>
@endsection