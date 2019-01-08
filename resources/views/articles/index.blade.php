@extends('layouts.app')

@section('jumbotron')
<div id="carouselExampleSlidesOnly" class="carousel slide bg-info" data-ride="carousel">
	<ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: First slide"><title>Placeholder</title><rect fill="#60A3D9" width="100%" height="100%"></rect><text fill="#555" dy=".3em" x="50%" y="50%">First slide</text></svg>
		</div>
		<div class="carousel-item">
			<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Second slide"><title>Placeholder</title><rect fill="#B5D45F" width="100%" height="100%"></rect><text fill="#444" dy=".3em" x="50%" y="50%">Second slide</text></svg>
		</div>
		<div class="carousel-item">
			<svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Third slide"><title>Placeholder</title><rect fill="#f66D9b" width="100%" height="100%"></rect><text fill="#333" dy=".3em" x="50%" y="50%">Third slide</text></svg>
		</div>
	</div>
</div>
<div class="jumbotron">
	<div class="container">
	  <h1 class="display-3">Hello, world!</h1>
	  <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
	  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
	</div>
</div>
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $market->name }}, {{ $market->state->name }} Articles</h1>
		</div>
	</div> <!-- End Row -->

	<div class="container">
		<div class="tripIdeas mb-3">
			<div class="d-flex justify-content-between border-bottom border-primary mb-3">
				<div><h2>Trip Ideas FLEXING</h2></div>
				<div>Sort by: Date?</div>
			</div>

			<div class="row card-deck">

				@foreach ($tripIdeas as $article)
				<div class="col-4 mb-3">
				<div class="card">

					<div class="card-img-top">
						{{ $article->getFirstMedia('inset') }}
					</div>

					<div class="card-body">
						<h5 class="card-title"><a href="{{ $article->path() }}">{{ $article->title }}</a></h5>
							{{-- <p>Published: {{ $article->publish_date->diffForHumans() }}</p> --}}
							<p class="card-text">{{ $article->excerpt }}</p>
						</div>

						@if ($article->tags->count())
						<div class="card-footer">
							@foreach($article->tags as $tag)
							<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="badge badge-secondary">{{ $tag->name }}</a>
							@endforeach
						</div>
						@endif

					</div>
					</div>
					@endforeach

				</div>
			</div>

		</div>


		<section id="tripIdeas">
			<h2>Trip Ideas</h2>
			<div class="row">
				<div class="card-deck mb-4">
					@foreach ($tripIdeas as $article)
					<div class="col-md-4">

						<div class="card mb-4">

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

						</div> <!-- End Column -->
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
