@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Edit Category</h1>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
@method('PATCH')
@csrf

	<div class="form-group">
			<label for="name">Category Name:</label>
            <input type="text" class="form-control" id="name" name="name"
               value="{{ old('name', $category->name) }}" required>
	</div>

	<div class="form-group">
		<label for="slug">Slug:</label>
        <input type="text" class="form-control" id="slug" name="slug"
               value="{{ old('slug', $category->slug) }}" required>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary btn-lg">Update Category</button>
	</div>
	<div class="form-group">
		<a href="/dashboard/markets" class="btn btn-secondary btn-lg">Cancel</a>
	</div>

	@if (Session::has('success'))
		<div class="alert alert-success" role="alert">
			<strong>Success:</strong> {{ Session::get('success') }}
		</div>
	@endif

	@if (count($errors))
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</form>

@endsection