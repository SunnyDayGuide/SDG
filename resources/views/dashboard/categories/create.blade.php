@extends('layouts.dashboard')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>Add a Category</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<form method="POST" action="{{ route('dashboard.categories.store') }}">
			{{ csrf_field() }}

				<div class="form-group">
						<label for="name">Category Name:</label>
	                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ old('name') }}" required>
				</div>

				<div class="form-group">
					<label for="slug">Slug:</label>
                    <input type="text" class="form-control" id="slug" name="slug"
                           value="{{ old('slug') }}" required>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg btn-block">Add Category</button>
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
		</div>

	</div> <!-- end of row -->
</div>

@endsection