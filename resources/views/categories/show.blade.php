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

<div class="container my-3 my-md-5">
	<div class="content">
		<div class="d-md-flex justify-content-between align-items-center">
			<div class="page-title">
				<h1 class="display-4">{{ $page->title }}</h1>
			</div>

		</div>
		<div class="fr-view">
			{!! $page->body !!}
		</div>
	</div>
</div>

<!--Subcategories carousel Section -->
<section id="main-panel" class="mt-5">
	<div class="container">
		@include('categories._subcat-panel')
	</div>
</section>
<!--End Subcategories carousel Section -->

<!-- Advertiser Listings Section -->
<section class="panel panel-light mt-5">
	<div class="container">
	<div class="text-center">
		<h2 class="font-weight-bold">Explore {{ $market->name }} {{ $category->name }}</h2>
	</div>

	@include('categories._search')

	<div class="d-md-flex justify-content-end mb-3">
		{{-- <h2>Featured {{ $category->name }}</h2> --}}
		<div class="coupon-legend d-flex align-items-center">
			<span class="fa-stack fa-sm">
				<i class="fas fa-certificate fa-stack-2x"></i>
				<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
			</span><span class="py-1">= Has Coupon</span>
		</div>
	</div>


	<!--Premier Advertisers Section -->
	@if(!$premierAdvertisers->isEmpty())
	@include('categories._advertisers-list-premier')
	@endif
	<!--End Premier Advertisers Section -->

	<!--Regular Advertisers Section -->
	@include('categories._advertisers-list')
	<!--End Regular Advertisers Section -->

	</div> <!-- End Container -->
</section>
<!-- End Advertiser Listings Section -->

<!--OLD Premier Advertisers Section -->
{{-- @if(!$premierAdvertisers->isEmpty())
<section id="premierAdvertisers" class="panel panel-advertisers mt-5">
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

		<div class="row">
			<div class="card-deck w-100 mx-md-0">
				@foreach ($premierAdvertisers as $premierAdvertiser)
				@include('advertisers._card', ['item' => $premierAdvertiser, 'column' => 'col-md-6', 'profile' => 'full', 'excerpt' => $premierAdvertiser->blurblong ])
				@endforeach
				@unless($premierAdvertisers->count() % 2 == 0)
				<div class="col-md-6 mb-md-4 mb-3 px-md-0 d-none d-md-block">
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
@endif --}}
<!--End OLD Premier Advertisers Section -->

<!-- Related Articles Section -->
<section class="panel panel-articles">
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

@section('scripts')
<script src="{{ asset('js/functions.js') }}"/></script>
@endsection
