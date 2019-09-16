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
<section id="page-content" class="panel pb-0">
<div class="container">
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
</section>

<!-- Advertiser Listings Section -->
<section id="advertisers" class="panel">
	<div class="container">
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
	</div>

		<!--Premier Advertisers Section -->
		@if(!$premierAdvertisers->isEmpty())
		<div class="container">
		@include('categories._advertisers-list-premier')
		</div>
		@endif
		<!--End Premier Advertisers Section -->

		<!--Subcategories carousel Section -->
		<section id="main-panel" class="panel panel-light mt-5">
			<div class="container">
				@include('categories._subcat-panel')
			</div>
		</section>
		<!--End Subcategories carousel Section -->

		<!--Regular Advertisers Section -->
		<div class="container">
		@include('categories._advertisers-list')
		</div>
		<!--End Regular Advertisers Section -->

</section>
<!-- End Advertiser Listings Section -->

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
