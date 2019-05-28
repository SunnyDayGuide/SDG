@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
	@include('articles._slider', ['items' => $featured, 'profile' => 'full'])
</div>
@endsection

@section('content')

<div class="search p-5">
	<h2 class="m-auto text-center">This is the search box</h2>
</div>

<div class="container mt-5">

	<div>
		<div>
			<h1>{{ $market->name }}, {{ $market->state->name }} Articles</h1>
		</div>
	</div> <!-- End Row -->

	@if(!$tripIdeas->isEmpty())
	<section id="tripIdeas" class="tripIdeas">
		<div class="d-flex justify-content-between border-bottom border-editorial mb-3">
			<h2>Trip Ideas</h2>
			<div>Sort by: Date?</div>
		</div>

		<div class="row article-cards">
			<div class="card-deck mx-md-0">
				@foreach ($tripIdeas as $article)
					@include('articles._card')
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
	@endif

	@include('banners._zone1')

	@if(!$visitorInfos->isEmpty())
	<section id="visitorInfo" class="visitorInfo">

		<div class="d-flex justify-content-between border-bottom border-primary mb-3">
			<h2>Visitor Info</h2>
			<div>Sort by: Date?</div>
		</div>

		<div class="row">
			<div class="col-md-9">
				@foreach ($visitorInfos as $article)
				<div class="media border-bottom border-light mb-3 pb-3">
					<div class="image mr-3 overlay">
						<a href="{{ $article->path() }}" class="overlay text-reset text-decoration-none">
							@include('partials._images', ['item' => $article, 'profile' => 'sm-card'])
						</a>
					</div>
					<div class="media-body">
						<h5 class="mt-0"><a href="{{ $article->path() }}">{{ $article->title }}</a></h5>
						<p>{{ $article->excerpt }}</p>

						@if ($article->tags->count())
						<div>
							@foreach($article->tags as $tag)
							<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
							@endforeach
						</div>
						@endif
					</div>
				</div>
				@endforeach
			</div>

			@include('banners._zone2')

		</div> <!-- End Row-->

	</section>
	@endif

</div> <!-- End Content Container -->

@if(!$advSpotlights->isEmpty())
	<section id="advSpotlights" class="advSpotlights mt-5">
		<div class="container">
			<div class="border-bottom border-white mb-3 w-100">
				<h2>Advertiser Spotlights</h2>
			</div>
			
			<div id="advCarousel" class="row carousel slide" data-ride="carousel" data-interval="false">
				<div class="carousel-inner">
					<div class="card-deck w-100">
						@foreach ($advSpotlights as $article)
						<div class="carousel-item col-md-4 {{ $loop->first ? 'active' : '' }}">

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
							</div>
							
						</div> <!-- End Column-->
						@endforeach
					</div> <!-- End Card Deck-->
				</div> <!-- End Row-->

				<div class="container">
					<div class="row">
						<div class="col-12 text-center mt-4">
							<a class="btn btn-outline-secondary mx-1 prev" href="javascript:void(0)" title="Previous">
								<i class="fa fa-lg fa-chevron-left"></i>
							</a>
							<a class="btn btn-outline-secondary mx-1 next" href="javascript:void(0)" title="Next">
								<i class="fa fa-lg fa-chevron-right"></i>
							</a>
						</div>
					</div>
				</div>

			</div>

		</div> <!-- End Ad Spot Container-->
	</section>
@endif

@endsection

@section('scripts')
<script type="application/javascript">
	(function ($) {
		"use strict";
  // Auto-scroll
  $('#myCarousel').carousel({
  	interval: 5000
  });

  // Control buttons
  $('.next').click(function () {
  	$('.carousel').carousel('next');
  	return false;
  });
  $('.prev').click(function () {
  	$('.carousel').carousel('prev');
  	return false;
  });

  // On carousel scroll
  $("#myCarousel").on("slide.bs.carousel", function (e) {
  	var $e = $(e.relatedTarget);
  	var idx = $e.index();
  	var itemsPerSlide = 3;
  	var totalItems = $(".carousel-item").length;
  	if (idx >= totalItems - (itemsPerSlide - 1)) {
  		var it = itemsPerSlide -
  		(totalItems - idx);
  		for (var i = 0; i < it; i++) {
        // append slides to end 
        if (e.direction == "left") {
        	$(
        		".carousel-item").eq(i).appendTo(".carousel-inner");
        } else {
        	$(".carousel-item").eq(0).appendTo(".carousel-inner");
        }
    }
}
});
})
	(jQuery);

</script>

@endsection
