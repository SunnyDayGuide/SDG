@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $market->name }}, {{ $market->state->name }} Articles</h1>
		</div>
	</div> <!-- End Row -->

	<section id="tripIdeas">
		<h2>Trip Ideas</h2>
		<div class="row">
			<div class="card-deck mb-4">
				@foreach ($tripIdeas as $article)

				<div class="card">

					<div class="card-img-top">
						{{ $article->getFirstMedia('inset') }}
					</div>

					<div class="card-body">
						<h5 class="card-title">{{ $article->title }}</h2>
						<p>Published: {{ $article->publish_date->diffForHumans() }}</p>
						<p class="card-text">{{ $article->excerpt }}</p>
						<a href="{{ $article->path() }}" class="btn btn-primary">Read More</a>
					</div> <!-- End Card Body-->

						@if ($article->tags->count())
						<div class="card-footer">
							@foreach($article->tags as $tag)
							<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="badge badge-secondary">{{ $tag->name }}</a>
							@endforeach
						</div>
						@endif

				</div> <!-- End Card -->
				@endforeach

			</div> <!-- End deck -->

		</div> <!-- End Row -->

		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					{!! $tripIdeas->links() !!}
				</div>
			</div>
		</div> <!-- End Row -->

		</section>

		<section id="visitorInfo">
			<h2>Visitor Info</h2>
			<div class="row">
				@foreach ($visitorInfos as $article)
				@endforeach
			</div> <!-- End Row -->
		</section>

		<section id="advSpotlights">
			<h2>Advertiser Spotlights</h2>
			<div class="row">
				@foreach ($advSpotlights as $article)
				@endforeach
			</div> <!-- End Row -->
		</section>

	</div>

	@endsection
