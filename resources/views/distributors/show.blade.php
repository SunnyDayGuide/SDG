@extends('layouts.app')

@section('content')

<!-- Main Content -->
<div class="container my-3 my-md-5">
	<div class="row">
		<div class="col-md-8 offset-md-2">

			<!-- Header -->
			<div class="d-flex align-content-center justify-content-between mb-md-4"> 
				<div class="">
					<h1>{{ $distributor->name }}</h1>

					<!-- Web & social buttons -->
					<div class=""> 
						<div class="web-buttons my-2">
							@if(count($distributor->locations) > 0)
							<a class="btn btn-distributor text-white mr-1" href="#show-map" role="button">Map</a>
							@endif

							@if($distributor->website_url)
							<a class="btn btn-distributor text-white" href="{{ $distributor->website_url }}" target="_blank" role="button">Website</a>
							@endif

							@if($distributor->reservation_url)
							<a class="btn btn-distributor text-white" href="{{ $distributor->reservation_url }}" target="_blank" role="button">Reservations</a>
							@endif

						</div>

						<div class="social my-2">
							@if($distributor->facebook)
							<a href="{{ $distributor->facebook }}" target="_blank" class="social-item text-light" aria-label="View {{ $distributor->name }} Facebook page"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($distributor->instagram)
							<a href="{{ $distributor->instagram }}" target="_blank" class="social-item text-light" aria-label="View {{ $distributor->name }} Instagram"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-instagram fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($distributor->twitter)
							<a href="{{ $distributor->twitter }}" target="_blank" class="social-item text-light" aria-label="View {{ $distributor->name }} Twitter feed"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-twitter fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($distributor->youtube)
							<a href="{{ $distributor->youtube }}" target="_blank" class="social-item text-light" aria-label="View {{ $distributor->name }} YouTube channel"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-youtube fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($distributor->pinterest)
							<a href="{{ $distributor->pinterest }}" target="_blank" class="social-item text-light" aria-label="View {{ $distributor->name }} Pinterest feed"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-pinterest fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($distributor->yelp)
							<a href="{{ $distributor->yelp }}" target="_blank" class="social-item text-light" aria-label="View {{ $distributor->name }} Yelp Page"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-yelp fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($distributor->tripadvisor)
							<a href="{{ $distributor->tripadvisor }}" target="_blank" class="social-item text-light" aria-label="View {{ $distributor->name }} TripAdvisor Reviews"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-tripadvisor fa-stack-1x fa-inverse"></i></span></a>
							@endif
						</div>

					</div> <!-- End Web & social buttons -->

				</div>

				@if($distributor->logo)
				<div class="flex-shrink-1 header-logo ml-3 d-none d-md-block">{{ $logo }}</div>
				@endif

			</div>

			@if($slides->count() > 1)
			<!-- Carousel -->
			<div id="carouselIndicators" class="carousel slide mb-2" data-ride="carousel">
				<ol class="carousel-indicators">
					@foreach($slides as $image)
					<li data-target="#carouselIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
					@endforeach
				</ol>
				<div class="carousel-inner" role="listbox">
					@foreach($slides as $image)
					<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
						{{ $image('full') }}
					</div>
					@endforeach
				</div>
			</div>

			{{-- Otherwise just spit out a single image --}}
			@else
			<div class="mb-2">
			{{ $image('full') }}
			</div>

			@endif

			<!-- Category Breadcrumbs -->
			<div class="d-flex flex-wrap align-items-baseline justify-content-end mb-2 mb-md-3">
				@foreach ($categories as $parent_id => $subcategories)
				@if($subcategories->first()->parent)
				<div class="mb-1 mb-md-0 ml-md-2">
					<a href="{{ $market->path().'/'.$subcategories->first()->parent->slug }}" class="text-decoration-none advertiser-cat mr-1">{{ $subcategories->first()->parent->name }}</a>
					@foreach ($subcategories as $subcategory)
					<a href="{{ $market->path().'/'.$subcategory->parent->slug.'/'.$subcategory->slug }}">{{ $subcategory->name }}</a>{{ $loop->last ? '' : ' / ' }}
					@endforeach
				</div>
				@endif
				@endforeach
			</div>

			<div class="d-flex align-items-center">
				<div class="bucket-instructions text-primary font-weight-bold mr-3 text-right">Add Coupon to your Bucket List <i class="fas fa-arrow-right"></i></div>
				<bucket-button item-id="{{ $distributor->id }}" item-class="Distributor" styles="bucket-btn"></bucket-button>
			</div>

			<!-- Write Up -->
			<div class="fr-view write-up">{!! $distributor->write_up !!}</div>

			<!-- Attributes -->
			<div class="row info my-4">
				<!-- Property Info -->
				@include('advertisers._accommodations-info', ['place' => $distributor]) 
				<!-- End Business Info -->

			</div>

		</div> <!-- End Column -->
	</div> <!-- End Row -->

	<!-- Map -->
	@if(count($locations) > 0)
	<div class="map-container">
		<button id="show-map" class="btn map-button">
			<img src="{{ asset('storage/images/main/map-button-graphic.svg') }}" alt="map button graphic">
			<div>Show Map</div>
		</button>
		<div class="placeholder bg-light">
			<img src="" alt="" class="img-fluid">
		</div>
	</div>
	<div id="map" style="display: none;"></div>
	@endif

	<!-- Locations -->
	<div class="row my-2">
		<div class="col-md-8 offset-md-2 locations">
			<div class="scrollarea">
				@foreach($locations as $location)
				<div class="d-md-flex justify-content-between border-bottom border-light my-4">
					<div class="flex-grow-1 py-1">
						<a href="{{ $location->directions }}" target="_blank" aria-label="Get directions to {{ $location->full_address }}">
							<i class="fas fa-map-marker-alt fa-lg fa-fw mr-2" title="Get directions to {{ $location->full_address }}"></i>{{ $location->full_address }}
						</a>
					</div>
					@isset($location->telephone)
					<div class="py-1">
						<a href="tel:{{ $location->telephone }}" aria-label="Call {{ $distributor->name }}">
							<i class="fas fa-phone fa-lg fa-fw mr-2" title="Call {{ $distributor->name }}"></i>{{ $location->telephone }}
						</a>
					</div>
					@endisset
				</div>
				@endforeach
			</div>
			@isset($distributor->toll_free)
			<div class="tollfree text-md-right">
				<p><a href="tel:{{ $distributor->toll_free }}" aria-label="Call {{ $distributor->name }}">
					<i class="fas fa-phone fa-lg fa-fw mr-2" title="Call {{ $distributor->name }}"></i>Call Toll-Free: {{ $distributor->toll_free }}
				</a></p>
			</div>
			@endisset
		</div>
	</div>

</div> <!-- End Main Content Div -->

@endsection

@section('scripts')

@include('advertisers._initMap', ['place' => $distributor])
@endsection