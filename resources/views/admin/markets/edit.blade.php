@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Update Market Info</h1>
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 mr-2">
			<form method="POST" action="{{ route('admin.markets.update', $market->id) }}">
				@method('PATCH')
				@csrf
				<div class="row form-group">
					<div class="col-md-10">
						<label for="name">Market Name:</label>
						<input type="text" class="form-control" id="name" name="name"
						value="{{ old('name', $market->name) }}" required>
					</div>
					<div class="col">
						<label for="name">Market Code:</label>
						<input type="text" class="form-control" id="code" name="code"
						value="{{ old('code', $market->code) }}" required>
					</div>
				</div>

				<div class="form-group">
					<label for="slug">Slug:</label>
					<input type="text" class="form-control" id="slug" name="slug"
					value="{{ old('slug', $market->slug) }}" required>
				</div>

				<div class="form-group">
					<label for="name_alt">Long/Alternate Name:</label>
					<input type="text" class="form-control" id="name_alt" name="name_alt"
					value="{{ old('name_alt', $market->name_alt) }}">
				</div>

				<div class="form-group">
					<label for="state_id">Primary State</label>
					<select class="form-control" name="state_id">
						<option selected>Select Select</option>
						@foreach($states as $state)
						<option value="{{ $state->id }}" {{ $market->state->id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="cities">Cities:</label>
					<input type="text" class="form-control" id="cities" name="cities"
					value="{{ old('cities', $market->cities) }}">
				</div>

				<div class="form-group">
					<label for="brand_id">Brand</label>
					<select class="form-control" name="brand_id">
						@foreach($brands as $brand)
						<option value="{{ $brand->id }}" {{ $market->brand->id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg btn-block">Update Market</button>
				</div>
				<div class="form-group">
					<a href="{{ route('admin.markets.index') }}" class="btn btn-secondary btn-lg btn-block">Cancel</a>
				</div>
			</form>
		</div>

		<div class="col">
			<div>
				<h4>{{ $market->name }} Categories</h4>
				<table class="table table-bordered">
					<thead class="thead-light">
						<th>Category Name</th>
						<th></th>
					</thead>
					<tbody>
						@foreach ($categories as $category)
						<tr>
							<td>{{ $category->name }}</td>
							<td align="right">
								<a href="{{ route('admin.marketCategory.edit', [$market->id, $category->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
								<div class="d-inline-block">
									<form action="{{ route('admin.marketCategory.destroy', [$market->id, $category->id]) }}" method="POST">
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
				<a href="{{ route('admin.marketCategory.create', $market->id) }}" class="btn btn-primary">Add a Market Category</a>
			</div>
		</div>

	</div>
	
	@include ('partials._messages')

</div>

@endsection