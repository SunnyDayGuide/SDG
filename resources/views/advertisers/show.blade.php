@extends('layouts.app')

@section('content')

<!-- Main Content -->
<div class="container my-3 my-md-5">
	<div class="row">
		<div class="col-md-8 offset-md-2">

			<!-- Header -->
			<div class="d-flex align-content-center justify-content-between mb-md-4"> 
				<div id="name_buttons">
					<h1>{{ $advertiser->name }}</h1>

					<!-- Web & social buttons -->
					<div id="buttons"> 
						<div class="web-buttons my-2 mb-1">
							@if(count($advertiser->locations) > 0)
							<a class="btn btn-advertiser mr-1 mb-1" href="#show-map" role="button">Map</a>
							@endif

							@if(count($advertiser->coupons) > 0)
							<a class="btn btn-advertiser mr-1 mb-1" href="#coupons" role="button">Coupons</a>
							@endif

							@if($advertiser->website_url)
							<a class="btn btn-advertiser mr-1 mb-1" href="{{ $advertiser->website_url }}" target="_blank" role="button">Website</a>
							@endif

							@if($advertiser->ticket_url)
							<a class="btn btn-advertiser mr-1 mb-1" href="{{ $advertiser->ticket_url }}" target="_blank" role="button">Tickets</a>
							@endif

							@if($advertiser->reservation_url)
							<a class="btn btn-advertiser mr-1 mb-1" href="{{ $advertiser->reservation_url }}" target="_blank" role="button">Reservations</a>
							@endif

							@if($advertiser->booking_url)
							<a class="btn btn-advertiser mr-1 mb-1" href="{{ $advertiser->booking_url }}" target="_blank" role="button">Book It</a>
							@endif

							@if(count($advertiser->shows) > 0)
							<a class="btn btn-advertiser mr-1 mb-1" href="#show-schedule" target="_blank" role="button">Show Schedule</a>
							@endif
						</div>

						<div class="social my-2">
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

			<!-- Write Up -->
			<div class="fr-view write-up">
				{!! $advertiser->write_up !!}
			</div>
			
			<div class="d-flex align-items-center my-4">
				<!-- Bucket button -->
				@include('partials._bucket-button', ['item' => $advertiser, 'class' => 'Advertiser', 'button' => 'button'])

				@if(count($advertiser->tags) > 0)
				<!-- Tags Links -->
				@include('tags._links', ['item' => $advertiser, 'color' => 'advertiser'])
				@endif
			</div>
			
			<!-- Attributes -->
			<div class="row info my-4">
				<!-- Business Info -->
				<div class="col-md-6 mb-4">
					<h4>More Business Info</h4>
					<ul class="list-unstyled">
						<li class="mb-3"><span class="amenity">Restrictions</span>
							{{ $advertiser->restrictions ? $advertiser->restrictions : 'None' }}
						</li>
						<li class="mb-3"><span class="amenity">Fully Accessible <i class="fab fa-accessible-icon"></i></span>{{ $advertiser->accessible ? 'Yes' : 'No' }}</li>
						<li class="mb-3"><span class="amenity">Pet Friendly</span>{{ $advertiser->pet_friendly ? 'Yes' : 'No' }}</li>
						<li><span class="amenity">Early Bird Specials</span>{{ $advertiser->early_bird_specials ? 'Yes' : 'No' }}</li>
						<li><span class="amenity">Military Discounts</span>{{ $advertiser->military_discount ? 'Yes' : 'No' }}</li>
						<li><span class="amenity">Senior Discounts</span>{{ $advertiser->senior_discount ? 'Yes' : 'No' }}</li>
					</ul>
					@foreach($ads as $ad)
					<a class="btn btn-advertiser text-white mt-3" href="{{ url($ad->file) }}" target="_blank" role="button">Guide Ad {{ $loop->count <= 1 ? '' : $loop->iteration }}</a>
					@endforeach
				</div> <!-- End Business Info -->

				<!-- Hours -->
				@if(count($advertiser->openingHours) > 0)
				<div class="col-md-6 mb-4 hours">
					@include('advertisers._hours')
				</div>
				@endif <!-- End Hours -->

				<!-- Restaurant Info -->
				@if($advertiser->isRestaurant())
				@include('advertisers._restaurant-info')
				@endif <!-- End Restaurant Info -->

				<!-- Accommodations Info -->
				@if($advertiser->isAccommodation())
				@include('advertisers._accommodations-info', ['place' => $advertiser])
				@endif <!-- End Accommodations Info -->
				
				@if(count($advertiser->articles) > 0)
				<!-- Related Articles -->
				<div class="col-md-6 mb-4">
					
					<h4>Related:</h4>
					<ul class="list-unstyled">
						@foreach($advertiser->articles as $article)
						<li><a href="{{ $article->path() }}">{{ $article->title }}</a></li>
						@endforeach
					</ul>
					
				</div>
				@endif <!-- End Related Articles -->


			</div>

		</div> <!-- End Column -->
	</div> <!-- End Row -->

	<!-- Map -->
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
						<a href="{{ $location->directions }}" target="_blank" aria-label="Get directions to {{ $location->full_address }}">
							<i class="fas fa-map-marker-alt fa-lg fa-fw mr-2" title="Get directions to {{ $location->full_address }}"></i>{{ $location->full_address }}
						</a>
					</div>
					@isset($location->telephone)
					<div class="py-1">
						<a href="tel:{{ $location->telephone }}" aria-label="Call {{ $advertiser->name }}">
							<i class="fas fa-phone fa-lg fa-fw mr-2" title="Call {{ $advertiser->name }}"></i>{{ $location->telephone }}
						</a>
					</div>
					@endisset
				</div>
				@endforeach
			</div>
			@isset($advertiser->toll_free)
			<div class="tollfree text-md-right">
				<p><a href="tel:{{ $advertiser->toll_free }}" aria-label="Call {{ $advertiser->name }}">
					<i class="fas fa-phone fa-lg fa-fw mr-2" title="Call {{ $advertiser->name }}"></i>Call Toll-Free: {{ $advertiser->toll_free }}
				</a></p>
			</div>
			@endisset
		</div>
	</div>

	<!-- Coupons -->
	@if($advertiser->coupons->count() > 0)
	<div class="row my-3 my-md-5" id="coupons">
		<div class="col-md-8 offset-md-2">
			<div class="text-uppercase print"><a href="{{ route('print.all', [$market, $advertiser]) }}"><i class="fas fa-print fa-lg fa-fw mr-2" title="Print all coupons"></i>Print all coupons</a></div>
			@include('advertisers._coupon')
		</div>
	</div>
	@endif

	@if(count($advertiser->shows) > 0)
	<!-- Schedule -->
	<div id="show-schedule" class="row my-4">
		<div class="col-md-8 offset-md-2">
			<script src="https://calendars.branson.com/js/2.1/calendar.js" type="application/javascript"></script>
			@foreach($advertiser->shows as $show)
			@include('show-schedule._schedule')
			@endforeach
		</div>
	</div>
	@endif

</div> <!-- End Main Content Div -->

@endsection

@section('scripts')

@include('advertisers._initMap', ['place' => $advertiser])
@endsection