@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Add a Tag</h1>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<form method="POST" action="{{ route('admin.tags.store') }}">
			{{ csrf_field() }}

				<div class="form-group">
						<label for="name">Tag Name:</label>
			            <input type="text" class="form-control" id="name" name="name"
			               value="{{ old('name') }}">
				</div>

				<div class="form-group">
					<label for="type">Tag Type</label>
					<select class="form-control" name="type">
						<option value="">Select Type</option>
						@foreach($categories->sortBy('name') as $category)
							<option value="{{ $category->name }}">{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg">Add Tag</button>
				</div>

				@include ('partials._messages')
			</form>
		</div>
	</div>
</div>
@endsection