@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $market->name }} {{ $category->name }}</h1>
		</div>
	</div> <!-- end row -->
	<div class="row">
		<div class="col-md-8">
			<form method="POST" action="/dashboard/markets/{{ $market->id }}/category/{{ $category->id }}">
			@method('PATCH')
		    @csrf

			<div class="form-group">
				<label for="title">Category Page Header</label>
				<input type="text" class="form-control" id="title" name="title" value="{{ old('title', $market_category->title) }}">
			</div>

			<div class="form-group">
				<label for="body">Category Page Body Text</label>
				<input type="text" class="form-control" id="body" name="body" value="{{ old('body', $market_category->body) }}">
			</div>

			<div class="form-group">
				<label for="image">Lead Image URL placeholder</label>
				<input type="text" class="form-control" id="image" name="image" value="{{ old('image', $market_category->image) }}">
			</div>

			<div class="form-group">
				<label for="meta_title">Meta Title</label>
				<textarea class="form-control" rows="2" id="meta_title" name="meta_title" value="{{ old('meta_title', $market_category->meta_title) }}"></textarea>
			</div>

			<div class="form-group">
				<label for="meta_description">Meta Description</label>
				<textarea class="form-control" rows="3" id="meta_description" name="meta_description" value="{{ old('meta_description', $market_category->meta_description) }}"></textarea>
			</div>

			<div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Update Category</button>
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