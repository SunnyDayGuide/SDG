@extends('layouts.admin')

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<h1>{{ $department->name }}</h1>
			</div>
			<div class="col-md-3 offset-md-1">
				<a href="{{ route('admin.departments.edit', $department->id) }}" class="btn btn-primary btn-block btn-lg">Edit Department</a>
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-md-8">
				<p><strong>Department Manager:</strong> {{ $department->manager->name }}</p>
				<p><strong>Employees:</strong></p>
				<ul>
				@foreach($department->employees as $employee)
					<li>{{ $employee->name }}</li>
				@endforeach
				</ul>
			</div>

		</div> <!-- End Row -->

	</div>

@endsection