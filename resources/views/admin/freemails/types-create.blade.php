@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Add a Freemail Type</h1>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<form method="POST" action="{{ route('admin.freemail-types.store') }}">
			{{ csrf_field() }}

				<div class="form-group">
					<label for="name">Type Name:</label>
		            <input type="text" class="form-control" id="name" name="name"
		               value="{{ old('name') }}" required>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg">Add Freemail Type</button>
				</div>

			</form>

			@include ('partials._messages')
			
		</div>
	</div>
</div>
@endsection