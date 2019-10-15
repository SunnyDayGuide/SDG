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
		<div class="page-title">
			<h1 class="display-4">{{ $page->title }}</h1>
		</div>

		<div class="fr-view page-body">
			{!! $page->body !!}
		</div>

	</div>
</div>

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
		
		@if(count($advertisers) >= 3)
		<!--Regular Advertisers Section -->
		@include('categories._advertisers-list')
		<!--End Regular Advertisers Section -->
		@endif

		@if(count($advertisers) < 3)
		<!--Regular Advertisers Section if less than 3 -->
		@include('categories._advertisers-list-horiz')
		<!--End Regular Advertisers Section if less than 3 -->
		@endif

	</div> <!-- End Container -->
</section>
<!-- End Advertiser Listings Section -->

@include('panels._related-articles', ['articles' => $relatedArticles])

@endsection

@section('scripts')
<script src="{{ asset('js/functions.js') }}"/></script>
@endsection
