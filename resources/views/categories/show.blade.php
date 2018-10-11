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
					@foreach ($articles as $article)
					<div class="col-lg-4">
						<div class="card mb-4">
							<img class="card-img-top" src="{{ $article->image }}" alt="">
							<div class="card-body">
								<h5 class="card-title">{{ $article->title }}</h2>
								<p>Published: {{ $article->published_at->diffForHumans() }}</p>
								<p class="card-text">{{ $article->excerpt }}</p>
								<a href="{{ $article->path() }}" class="btn btn-primary">Read More</a>
								<p>{{ $article->market->name }} {{ $article->articleType->name }}</p>
							</div> <!-- End Card Body-->
						</div> <!-- End Card -->
					</div> <!-- End Collumn -->
					@endforeach
				</div>
			</div>
		</div> <!-- End Row -->

	</div>

@endsection
