@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ $category->pivot->title }}</h1>
				<img src="{{ asset($category->pivot->image) }}" class="img-fluid" alt="{{ $category->pivot->title }}">
				<div class="mt-4">
					<p>{{ $category->pivot->body }}</p>
				</div>
			</div>	
		</div> <!-- End Row -->

		<hr>

		<div class="row mt-5 bg-light">
			<div class="col-md-12">
				<h2>Related Articles</h2>
				<div class="row">
					@include('articles._featured')
				</div>
			</div>
		</div> <!-- End Row -->

	</div>

@endsection
