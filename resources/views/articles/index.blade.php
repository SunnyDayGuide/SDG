@extends('layouts.app')

@section('jumbotron')
	<div>
		@include('articles._slider')
	</div>
@endsection

@section('content')

<div class="search p-5">
	<h2 class="m-auto text-center">This is the search box</h2>
</div>

<div class="container mt-5">

	<div class="row">
		<div class="col-12">
			<h1>{{ $market->name }}, {{ $market->state->name }} Articles</h1>
		</div>
	</div> <!-- End Row -->

	<section id="tripIdeas" class="tripIdeas">
		<div class="d-flex justify-content-between border-bottom border-editorial mb-3">
			<h2>Trip Ideas</h2>
			<div>Sort by: Date?</div>
		</div>

		<div class="row">
			<div class="card-deck">
				@foreach ($tripIdeas as $article)
				<div class="col-md-4 mb-3">
					<div class="card h-100" style="width: 100%;">
						<div class="card-img-top">
							@include('partials._images', ['item' => $article])
						</div>
						<div class="card-body">
							<h5 class="card-title"><a href="{{ $article->path() }}">{{ $article->title }}</a></h5>
							<p class="card-text">{{ $article->excerpt }}</p>
						</div>
						@if ($article->tags->count())
						<div class="card-footer">
							@foreach($article->tags as $tag)
							<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
							@endforeach
						</div>
						@endif
					</div> <!-- End Card-->
				</div> <!-- End Column-->
				@endforeach
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->

		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					{!! $tripIdeas->links() !!}
				</div>
			</div>
		</div>

	</section>

	<section class="ads">
		<div class="row justify-content-center">
			<div class="col-8">
				<img src="http://lorempixel.com/gray/900/272/technics/" alt="" class="img-fluid">
			</div>
		</div>
	</section>

	<section id="visitorInfo" class="visitorInfo">

		<div class="d-flex justify-content-between border-bottom border-editorial mb-3">
			<h2>Visitor Info</h2>
			<div>Sort by: Date?</div>
		</div>

		<div class="row">
			<div class="col-md-9">
				@foreach ($visitorInfos as $article)
				<div class="row mb-3 stacked-cards">
					<div class="col-md-4">
						@include('partials._images', ['item' => $article, 'profile' => 'sm-card'])
					</div>
					<div class="col">
						<h5 class="mt-0"><a href="{{ $article->path() }}">{{ $article->title }}</a></h5>
						<p>{{ $article->excerpt }}</p>

						@if ($article->tags->count())
						<div>
							@foreach($article->tags as $tag)
							<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="badge badge-secondary">{{ $tag->name }}</a>
							@endforeach
						</div>
						@endif
					</div>
				</div>
				@endforeach
			</div>

			<div class="col-md-3 mr-0">
				<img src="https://lorempixel.com/gray/400/900/technics" alt="" class="img-fluid">
			</div>

		</div> <!-- End Row-->

	</section>

	<section id="advSpotlights" class="advSpotlights">

		<div class="d-flex justify-content-between border-bottom border-advertiser mb-3 w-100">
			<h2>Advertiser Spotlights</h2>
			<div>Sort by: Date?</div>
		</div>

		<div class="row">
			<div class="card-deck w-100">
				@foreach ($advSpotlights as $article)
				<div class="col-md-4 mb-3">
					<div class="card h-100" style="width: 100%;">
						<div class="card-img-top">
							@include('partials._images', ['item' => $article])
						</div>
						<div class="card-body">
							<h5 class="card-title"><a href="{{ $article->path() }}">{{ $article->title }}</a></h5>
							<p class="card-text">{{ $article->excerpt }}</p>
						</div>
						@if ($article->tags->count())
						<div class="card-footer">
							@foreach($article->tags as $tag)
							<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
							@endforeach
						</div>
						@endif
					</div> <!-- End Card-->
				</div> <!-- End Column-->
				@endforeach
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->

	</section>

</div> <!-- End Content Container -->

@endsection
