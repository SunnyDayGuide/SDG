@extends('layouts.app')

@section('content')

<!-- Main Content -->
<div class="container my-3 my-md-5">
	<div class="row">
		<div class="col-md-8 offset-md-2">

			<!-- Header -->
			<div class="d-flex mb-3"> 
				<div class="flex-grow-1">
					<h1>{{ $advertiser->name }}</h1>

					<!-- Web & social buttons -->
					<div class=""> 
						<div class="web-buttons mr-3 mb-2 mb-md-0">
							@if(count($advertiser->locations) > 0)
							<a class="btn btn-advertiser text-white mr-1" href="#show-map" role="button">Map</a>
							@endif

							@if(count($advertiser->coupons) > 0)
							<a class="btn btn-advertiser text-white mr-1" href="#coupons" role="button">Coupons</a>
							@endif

							@if($advertiser->website_url)
							<a class="btn btn-advertiser text-white" href="{{ $advertiser->website_url }}" target="_blank" role="button">Website</a>
							@endif

							@if($advertiser->ticket_url)
							<a class="btn btn-advertiser text-white" href="{{ $advertiser->ticket_url }}" target="_blank" role="button">Tickets</a>
							@endif

							@if($advertiser->reservation_url)
							<a class="btn btn-advertiser text-white" href="{{ $advertiser->reservation_url }}" target="_blank" role="button">Reservations</a>
							@endif

							@if($advertiser->booking_url)
							<a class="btn btn-advertiser text-white" href="{{ $advertiser->booking_url }}" target="_blank" role="button">Book It</a>
							@endif
						</div>

						<div class="social mt-3">
							@if($advertiser->facebook)
							<a href="{{ $advertiser->facebook }}" target="_blank" class="social-item text-light" aria-label="View {{ $advertiser->name }} Facebook page"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($advertiser->instagram)
							<a href="{{ $advertiser->instagram }}" target="_blank" class="social-item text-light" aria-label="View {{ $advertiser->name }} Instagram"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-instagram fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($advertiser->twitter)
							<a href="{{ $advertiser->twitter }}" target="_blank" class="social-item text-light" aria-label="View {{ $advertiser->name }} Twitter feed"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-twitter fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($advertiser->youtube)
							<a href="{{ $advertiser->youtube }}" target="_blank" class="social-item text-light" aria-label="View {{ $advertiser->name }} YouTube channel"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-youtube fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($advertiser->pinterest)
							<a href="{{ $advertiser->pinterest }}" target="_blank" class="social-item text-light" aria-label="View {{ $advertiser->name }} Pinterest feed"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-pinterest fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($advertiser->yelp)
							<a href="{{ $advertiser->yelp }}" target="_blank" class="social-item text-light" aria-label="View {{ $advertiser->name }} Yelp Page"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-yelp fa-stack-1x fa-inverse"></i></span></a>
							@endif

							@if($advertiser->tripadvisor)
							<a href="{{ $advertiser->tripadvisor }}" target="_blank" class="social-item text-light" aria-label="View {{ $advertiser->name }} TripAdvisor Reviews"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-tripadvisor fa-stack-1x fa-inverse"></i></span></a>
							@endif
						</div>

					</div> <!-- End Web & social buttons -->

				</div>
				@if($advertiser->logo)
				<div class="header-logo ml-3 d-none d-md-block">{{ $logo }}</div>
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

			<!-- Write Up -->
			<div class="fr-view write-up">{!! $advertiser->write_up !!}</div>

			<div class="my-3">
				@foreach($advertiser->tags as $tag)
				<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
				@endforeach
			</div>

			<!-- Attributes -->
			<div class="row info my-4">
				<!-- Business Info -->
				<div class="col-md-6 mb-4">
					<h4>More Business Info</h4>
					<ul class="list-unstyled">
						<li>Some amenity here</li>
						<li>Some amenity here</li>
						<li>Some amenity here</li>
					</ul>
					@foreach($ads as $ad)
					<a class="btn btn-advertiser text-white" href="{{ url($ad->file) }}" target="_blank" role="button">Guide Ad {{ $loop->count <= 1 ? '' : $loop->iteration }}</a>
					@endforeach
				</div>

				<!-- Hours -->
				<div class="col-md-6 mb-4 hours">
					@if($hasHours)
					@include('advertisers._hours')
					@endif
				</div>

				<!-- Restaurant Info -->
				@if($advertiser->categories->contains(2))
				<div class="col-md-6">
					<h4>Restaurant Info</h4>
					<ul class="list-unstyled">
						<li>Some amenity here</li>
						<li>Some amenity here</li>
						<li>Some amenity here</li>
					</ul>

					@foreach($menus as $menu)
					<a class="btn btn-advertiser text-white" href="{{ url($menu->file) }}" target="_blank" role="button">View Menu {{ $loop->count <= 1 ? '' : $loop->iteration }}</a>
					@endforeach

				</div>
				@endif

			</div>

		</div>
	</div> <!-- End Row -->

	<!-- Map -->
	<!-- Come back here and do straight up embed for one location partial -->
	@if(count($locations) > 0)
	<div class="map-container">
		<button id="show-map" class="btn map-button">
			<img src="{{ asset('images/main/map-button-graphic.svg') }}" alt="map button graphic">
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
						<a href="{{ $location->directions }}" target="_blank" aria-label="Get directions to {{ $advertiser->name }}">
							<i class="fas fa-map-marker-alt fa-lg fa-fw mr-2" aria-hidden="true"></i>{{ $location->full_address }}
						</a>
					</div>
					@isset($location->telephone)
					<div class="py-1">
						<a href="tel:{{ $location->telephone }}" aria-label="Call {{ $advertiser->name }}">
							<i class="fas fa-phone fa-lg fa-fw mr-2" aria-hidden="true"></i>{{ $location->telephone }}
						</a>
					</div>
					@endisset
				</div>
				@endforeach
			</div>
			@isset($advertiser->toll_free)
			<div class="tollfree text-md-right">
				<p><a href="tel:{{ $advertiser->toll_free }}" aria-label="Call {{ $advertiser->name }}">
					<i class="fas fa-phone fa-lg fa-fw mr-2" aria-hidden="true"></i>Call Toll-Free: {{ $advertiser->toll_free }}
				</a></p>
			</div>
			@endisset
		</div>
	</div>

	<!-- Coupons -->
	@if($advertiser->coupons->count() > 0)
	<div class="row my-3 my-md-5" id="coupons">
		<div class="col-md-8 offset-md-2">
			<div class="text-uppercase print"><a href="{{ route('print.all', [$market, $advertiser]) }}"><i class="fas fa-print fa-lg fa-fw mr-2" aria-hidden="true"></i>Print all coupons</a></div>
			@include('advertisers._coupon')
		</div>
	</div>
	@endif

</div> <!-- End Main Content Div -->

@endsection

@section('scripts')
@include('advertisers._initMap')
@endsection