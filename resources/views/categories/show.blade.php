@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
	{{-- If there is more than one image, render a slider --}}
	@if($slides->count() > 1)
	<div id="slider" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach($slides as $slide)
			<li data-target="#slider" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
			@endforeach
		</ol>
		<div class="carousel-inner" role="listbox">
			@foreach($slides as $slide)
			<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
				{{ $slide('full') }}
			</div>
			@endforeach
		</div>
	</div>

	{{-- Otherwise just spit out a single image --}}
	@else
	{{ $image }}

	@endif

</div>
@endsection

@section('content')

@include('categories._search')

<div class="container mt-5">
	<div>
		<div class="content">
			<h1>{{ $page->title }}</h1>
			<div class="fr-view">{!! $page->body !!}</div>
		</div>
	</div> <!-- End Row -->
</div>


@if(!$premierAdvertisers->isEmpty())
<section id="premierAdvertisers" class="panel premier-advertisers mt-5">
	<div class="container">
		<div class="d-md-flex justify-content-between border-bottom border-white mb-3">
			<h2>Featured {{ $category->name }}</h2>
			<div class="coupon-legend d-flex align-items-center">
				<span class="fa-stack fa-sm">
					<i class="fas fa-certificate fa-stack-2x"></i>
					<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
				</span><span class="py-1">= Has Coupon</span>
			</div>
		</div>

		<div class="row article-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach ($premierAdvertisers as $premierAdvertiser)
				@include('advertisers._card', ['item' => $premierAdvertiser, 'column' => 'col-md-6', 'profile' => 'full'])
				@endforeach
				@unless($premierAdvertisers->count() % 2 == 0)
				<div class="col-md-6 mb-md-4 mb-3 px-md-0">
					<div class="filler-card">
						<div class="list-group">
							@foreach ($articles as $article)
							<a href="#" class="list-group-item list-group-item-action">
								<div class="d-flex w-100 justify-content-between">
									<h5 class="mb-1">{{ $article->title }}</h5>
									<small>{{ $article->publish_date->diffForHumans() }}</small>
								</div>
								<p class="mb-1">{{ $article->blurb }}</p>
								<small>Rating: {{ $article->rating }}</small>
							</a>
							@endforeach
						</div>
					</div>
				</div>
				@endunless
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->
	</div>
</section>
@endif

<section id="advertisers" class="container advertisers my-5">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="d-md-flex justify-content-between border-bottom border-advertisers mb-3">
				<h2>{{ $category->name }} Listings</h2>
				<div class="coupon-legend d-flex align-items-center">
					<span class="fa-stack fa-sm">
						<i class="fas fa-certificate fa-stack-2x"></i>
						<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
					</span><span class="py-1">= Listing has a Coupon</span>
				</div>
			</div>

			<div class="row advertiser-cards">
				<div class="card-deck w-100 mx-md-0">
					@foreach ($advertisers as $advertiser)
					@include('advertisers._card', ['item' => $advertiser, 'column' => 'col-md-4', 'profile' => 'card'])
					@if($loop->iteration == 6)
					@include('categories._subcat-panel')
					@endif
					@if($loop->iteration % 15 == 0)
						<div class="col-12 bg-light py-5 mt-4 mb-5 text-white">I AM A BANNER AD</div>
					@endif
					@endforeach
					@unless($advertisers->count() % 3 == 0)
					<div class="col mb-md-4 mb-3 px-md-0">
						<div class="filler-card">
							<div class="bg-light py-5 mt-4 mb-5 text-white">I AM A GOOGLE AD</div>
						</div>
					</div>
					@endunless
					@if($advertisers->count() < 6)
						<div class="col-12 bg-light py-5 mt-4 mb-5 text-white">I AM A BANNER AD</div>
					@endif

				</div> <!-- End Card Deck-->
			</div> <!-- End Cards Row-->
		</div>
	</div>
</section>

<!-- Related Articles Section -->
<section class="panel related-articles mt-5">
	<div class="container">

		<div class="border-bottom border-white mb-3 w-100">
			<h2>You May Also Be Interested In</h2>
		</div>

		<div class="row article-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach ($articles as $article)
				@include('articles._card')
				@endforeach
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->			

	</div>
</section> <!-- End Related Articles Section -->

@endsection
