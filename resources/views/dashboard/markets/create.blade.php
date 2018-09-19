@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1>Add a Market</h1>
		</div>

		<div class="col-md-4">
			<a href="../markets" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Back to All Markets</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<form action="POST" action="/markets">
			{{ csrf_field() }}

				<div class="form-group">
					<label for="category_id">Categories</label>
					@foreach($categories->sortBy('name') as $category)
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="{{ $category->id }}">
							<label class="form-check-label" for="{{ $category->id }}">
							{{ $category->name }}
							</label>
						</div>
					@endforeach
				</div>

			</form>
		</div>

	</div> <!-- end of row -->
</div>
@endsection