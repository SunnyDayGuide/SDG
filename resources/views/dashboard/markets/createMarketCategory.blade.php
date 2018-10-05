@extends('layouts.dashboard')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Add a Category to {{ $market->name }}</h1>
		</div>
	</div> <!-- end row -->
	<div class="row">
		<div class="col-md-8">
			<form method="POST" action="{{ route('dashboard.marketCategory.store', $market->id) }}" enctype="multipart/form-data">
			    @csrf

			    <div class="form-group">
					<label for="category_id">Category</label>
					<select class="form-control" name="category_id">
						<option selected>Select Category</option>
						@foreach($categories->sortBy('name') as $category)
							<option value='{{ $category->id }}'>{{ $category->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="title">Category Page Header</label>
					<input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
				</div>

				<div class="form-group">
					<label for="body">Category Page Body Text</label>
					<input type="text" class="form-control" id="body" name="body" value="{{ old('body') }}">
				</div>

				<div class="form-group">
					<label for="image">Lead Image</label>
					<input type="file" class="form-control-file" id="image" name="image" value="{{ old('image') }}">
				</div>

				<div class="form-group">
					<label for="meta_title">Meta Title</label>
					<textarea class="form-control" rows="2" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">{{ old('meta_title') }}</textarea>
				</div>

				<div class="form-group">
					<label for="meta_description">Meta Description</label>
					<textarea class="form-control" rows="3" id="meta_description" name="meta_description" value="{{old('meta_description')}}">{{old('meta_description')}}</textarea>
				</div>

				<div class="form-group">
	                <button type="submit" class="btn btn-primary btn-lg btn-block">Add Market Category</button>
	            </div>
	            <div class="form-group">
					<a href="/dashboard/markets/{{ $market->id }}" class="btn btn-secondary btn-lg btn-block">Cancel</a>
				</div>
			</form>

			@include('partials._messages')

		</div>
	</div>
</div> <!-- end of container -->

@endsection