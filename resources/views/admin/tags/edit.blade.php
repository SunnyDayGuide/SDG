@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Edit Tag</h1>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<form method="POST" action="{{ route('admin.tags.update', $tag->id) }}">
			@method('PATCH')
			@csrf

				<div class="form-group">
						<label for="name">Tag Name:</label>
			            <input type="text" class="form-control" id="name" name="name"
			               value="{{ old('name', $tag->name) }}" required>
				</div>

				<div class="form-group">
					<label for="tag_group">Tag Type</label>
					<select class="form-control" name="type">
						<option value="">Select Group</option>
						@foreach($categories->sortBy('name') as $category)
							<option value="{{ $category->name }}" {{ $tag->type == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg">Update Tag</button>
				</div>

				@include ('partials._messages')
			</form>
		</div>
	</div>
</div>
@endsection