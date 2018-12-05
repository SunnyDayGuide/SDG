@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Update Freemail Type</h1>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<form method="POST" action="{{ route('admin.freemail-types.update', $freemailType->id) }}">
			@method('PATCH')
			{{ csrf_field() }}

				<div class="form-group">
					<label for="name">Type Name:</label>
		            <input type="text" class="form-control" id="name" name="name"
		               value="{{ old('name', $freemailType->name) }}" required>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg">Update Freemail Type</button>
				</div>

			</form>

			@include ('partials._messages')
			
		</div>
	</div>
</div>
@endsection