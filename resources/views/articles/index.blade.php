@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<h1>{{ $market->name }}, {{ $market->state->name }} Articles</h1>
			</div>
		</div> <!-- End Row -->
		
		<section>
			<h2>Trip Ideas</h2>
			<div class="row">
				@foreach ($tripIdeas as $article)
					<div class="col-lg-4">
						<div class="card mb-4">
							<img class="card-img-top" src="{{ asset($article->image) }}" alt="">
							<div class="card-body">
								<h5 class="card-title">{{ $article->title }}</h2>
								<p>Published: {{ $article->published_at->diffForHumans() }}</p>
								<p class="card-text">{{ $article->excerpt }}</p>
								<a href="{{ $article->path() }}" class="btn btn-primary">Read More</a>
							</div> <!-- End Card Body-->
						</div> <!-- End Card -->
					</div> <!-- End Collumn -->
				@endforeach
			</div> <!-- End Row -->
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
{{-- 					{!! $tripIdeas->links() !!}
 --}}					</div>
				</div>
			</div> <!-- End Row -->
		</section>

		<section>
			<h2>Visitor Info</h2>
			<div class="row">
				@foreach ($visitorInfos as $article)
					<div class="col-lg-3">
						<div class="card mb-4">
							<img class="card-img-top" src="{{ $article->image }}" alt="">
							<div class="card-body">
								<h5 class="card-title">{{ $article->title }}</h2>
								<p>Published: {{ $article->published_at->diffForHumans() }}</p>
								<p class="card-text">{{ $article->excerpt }}</p>
								<a href="{{ $article->path() }}" class="btn btn-primary">Read More</a>
							</div> <!-- End Card Body-->
						</div> <!-- End Card -->
					</div> <!-- End Collumn -->
				@endforeach
			</div> <!-- End Row -->
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
{{-- 					{!! $visitorInfos->links() !!}
 --}}					</div>
				</div>
			</div> <!-- End Row -->
		</section>

		<section>
			<h2>Advertiser Spotlights</h2>
			<div class="row">
				@foreach ($advSpotlights as $article)
					<div class="col-lg-4">
						<div class="card mb-4">
							<img class="card-img-top" src="{{ $article->image }}" alt="">
							<div class="card-body">
								<h5 class="card-title">{{ $article->title }}</h2>
								<p>Published: {{ $article->published_at->diffForHumans() }}</p>
								<p class="card-text">{{ $article->excerpt }}</p>
								<a href="{{ $article->path() }}" class="btn btn-primary">Read More</a>
							</div> <!-- End Card Body-->
						</div> <!-- End Card -->
					</div> <!-- End Collumn -->
				@endforeach
			</div> <!-- End Row -->
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
{{-- 					{!! $advSpotlights->links() !!}
 --}}					</div>
				</div>
			</div> <!-- End Row -->
		</section>

	</div>

@endsection
