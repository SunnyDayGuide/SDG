@extends('layouts.dashboard')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>Add a Market</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<form method="POST" action="{{ route('dashboard.markets.store') }}">
			{{ csrf_field() }}

				<div class="row form-group">
					<div class="col-md-10">
						<label for="name">Market Name:</label>
	                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ old('name') }}" required>
					</div>
					<div class="col">
						<label for="name">Market Code:</label>
	                    <input type="text" class="form-control" id="code" name="code"
                           value="{{ old('code') }}" required>
					</div>
				</div>

				<div class="form-group">
					<label for="slug">Slug:</label>
                    <input type="text" class="form-control" id="slug" name="slug"
                           value="{{ old('slug') }}" required>
				</div>

				<div class="form-group">
					<label for="name_alt">Long/Alternate Name:</label>
                    <input type="text" class="form-control" id="name_alt" name="name_alt"
                           value="{{ old('name_alt') }}">
				</div>

				<div class="row form-group">
					<div class="col-md-10">
						<label for="state">State:</label>
	                    <input type="text" class="form-control" id="state" name="state"
                           value="{{ old('state') }}" required>
					</div>
					<div class="col">
						<label for="state_code">State Code:</label>
	                    <input type="text" class="form-control" id="state_code" name="state_code"
                           value="{{ old('state_code') }}" required>
					</div>
				</div>

				<div class="form-group">
					<label for="cities">Cities:</label>
                    <input type="text" class="form-control" id="cities" name="cities"
                       value="{{ old('cities') }}">
				</div>

				<div class="form-group">
					<label for="brand_id">Brand</label>
					<select class="form-control" name="brand_id">
						<option selected>Select Brand</option>
						@foreach($brands as $brand)
							<option value='{{ $brand->id }}'>{{ $brand->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="categories">Categories</label>
					@foreach($categories->sortBy('name') as $category)
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" {{ ( is_array(old('categories')) && in_array($category->id, old('categories')) ) ? 'checked ' : '' }}>
							<label class="form-check-label" for="{{ $category->id }}">
							{{ $category->name }}
							</label>
						</div>
					@endforeach
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg btn-block">Add Market</button>
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