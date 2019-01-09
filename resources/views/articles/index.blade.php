@extends('layouts.app')

@section('jumbotron')
<div class="mb-4">
<div id="carouselExampleSlidesOnly" class="carousel slide bg-info" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="http://lorempixel.com/1920/700/sports/1" alt="" class="img-fluid">
		</div>
		<div class="carousel-item">
			<img src="http://lorempixel.com/1920/700/sports/2" alt="" class="img-fluid">
		</div>
		<div class="carousel-item">
			<img src="http://lorempixel.com/1920/700/sports/3" alt="" class="img-fluid">
		</div>
	</div>
</div>
</div>
@endsection

@section('content')

<div class="container">

	<div class="row">
		<div class="col-12">
			<h1>{{ $market->name }}, {{ $market->state->name }} Articles</h1>
		</div>
	</div> <!-- End Row -->

	<section id="tripIdeas" class="tripIdeas">
		<div class="d-flex justify-content-between border-bottom border-primary mb-3">
			<div><h2>Trip Ideas</h2></div>
			<div>Sort by: Date?</div>
		</div>

		<div class="row">
			<div class="card-deck">
				@foreach ($tripIdeas as $article)
				<div class="col-md-4 mb-3">
					<div class="card" style="width: 100%;">
						<div class="card-img-top">
							{{ $article->getFirstMedia('inset') }}
						</div>
						<div class="card-body">
							<h5 class="card-title"><a href="{{ $article->path() }}">{{ $article->title }}</a></h5>
							<p class="card-text">{{ $article->excerpt }}</p>
						</div>
						@if ($article->tags->count())
						<div class="card-footer">
							@foreach($article->tags as $tag)
							<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn tags text-white">{{ $tag->name }}</a>
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

	<section id="visitorInfo">
		<div class="d-flex justify-content-between border-bottom border-primary mb-3">
			<div><h2>Visitor Info</h2></div>
			<div>Sort by: Date?</div>
		</div>
		<div class="row">
			<div class="col-12 d-flex justify-content-between border-bottom border-primary mb-3">
				<div><h2>Visitor Info</h2></div>
				<div>Sort by: Date?</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-9 ml-0">
				@foreach ($tripIdeas as $article)
				<div class="row mb-3 visitorinfo">
					<div class="col-md-4 pl-0">
						{{ $article->getFirstMedia('inset') }}
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

	<section id="advSpotlights">

		<div class="row">
			<div class="col-12 d-flex justify-content-between border-bottom border-primary mb-3">
				<div><h2>Advertiser Spotlights</h2></div>
				<div>Sort by: Date?</div>
			</div>
		</div>

		<div class="row">
			<div class="card-deck">
				@foreach ($advSpotlights as $article)
				<div class="col-md-4 mb-3">
					<div class="card" style="width: 100%;">
						<div class="card-img-top">
							{{ $article->getFirstMedia('inset') }}
						</div>
						<div class="card-body">
							<h5 class="card-title"><a href="{{ $article->path() }}">{{ $article->title }}</a></h5>
							<p class="card-text">{{ $article->excerpt }}</p>
							<a href="#" class="btn btn-primary">Go somewhere</a>
						</div>
						@if ($article->tags->count())
						<div class="card-footer">
							@foreach($article->tags as $tag)
							<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="badge badge-secondary">{{ $tag->name }}</a>
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
