@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<!-- Main Content -->
	<div class="pt-3 pt-md-5">
		<div class="row">
			<div class="col-md-8 offset-md-2">

				<!-- Header -->
				<div class="d-flex mb-3"> 
					<div class="flex-grow-1">
						<h1>{{ $advertiser->name }}</h1>

						<!-- Web & social buttons -->
						<div class="d-md-flex align-items-center"> 
							<div class="web-buttons mr-3 mb-2 mb-md-0">
								<a class="btn btn-advertiser text-white mr-1" href="#map" role="button">Map</a>
								<a class="btn btn-advertiser text-white mr-1" href="#coupons" role="button">Coupons</a>
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

							<div class="social">
								@if($advertiser->facebook)
									<a href="{{ $advertiser->facebook }}" class="rounded-circle bg-light text-white social-item fb" aria-label="View {{ $advertiser->name }} Facebook page"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
								@endif
								@if($advertiser->instagram)
									<a href="{{ $advertiser->instagram }}" class="rounded-circle bg-light text-white social-item ig" aria-label="View {{ $advertiser->name }} Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
								@endif
								@if($advertiser->twitter)
									<a href="{{ $advertiser->twitter }}" class="rounded-circle bg-light text-white social-item" aria-label="View {{ $advertiser->name }} Twitter feed"><i class="fab fa-twitter" aria-hidden="true"></i></a>
								@endif
								@if($advertiser->youtube)
									<a href="{{ $advertiser->youtube }}" class="rounded-circle bg-light text-white social-item yt" aria-label="View {{ $advertiser->name }} YouTube channel"><i class="fab fa-youtube" aria-hidden="true"></i></a>
								@endif
								@if($advertiser->pinterest)
									<a href="{{ $advertiser->pinterest }}" class="rounded-circle bg-light text-white social-item" aria-label="View {{ $advertiser->name }} Pinterest feed"><i class="fab fa-pinterest" aria-hidden="true"></i></a>
								@endif
							</div>

						</div> <!-- End Web & social buttons -->
						
					</div>
					<div class="w-25 ml-auto d-none d-md-block">{{ $logo }}</div>
				</div>

				<!-- Carousel -->
				<div id="carouselIndicators" class="carousel slide mb-2" data-ride="carousel">
					<ol class="carousel-indicators">
						@foreach($sliderImages as $image)
						<li data-target="#carouselIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
						@endforeach
					</ol>
					<div class="carousel-inner" role="listbox">
						@foreach($sliderImages as $image)
						<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
							{{ $image('full') }}
						</div>
						@endforeach
					</div>
				</div>

				<!-- Categories / tags -->
				<div class="d-flex flex-wrap align-items-baseline justify-content-end mb-2 mb-md-3">
						@foreach($supercategories as $category)
						<div class="mb-1 mb-md-0 ml-md-2">
							<a href="{{ $market->path().'/'.$category->slug }}" class="text-decoration-none advertiser-cat mr-1">{{ $category->name }}</a>
							@foreach ($subcategories->where('parent_id', $category->id) as $subcategory)
                                <a href="{{ $market->path().'/'.$category->slug.'/'.$subcategory->slug }}">{{ $subcategory->name }}</a>{{ $loop->last ? '' : ' / ' }}
                            @endforeach
                        </div>
						@endforeach
					{{-- <div class="ml-3">
						@foreach($advertiser->tags as $tag)
							<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white ml-2 tags">{{ $tag->name }}</a>
						@endforeach
					</div> --}}
				</div>
				
				<!-- Write Up -->
				<div class="fr-view">{!! $advertiser->write_up !!}</div>

				<div class="my-3">
					@foreach($advertiser->tags as $tag)
						<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
					@endforeach
				</div>

				<!-- Hours -->
				<div class="tab">
					<h4>Opening Hours</h4>
					<div class="row">
						<ul>
							@foreach($thisWeek as $day => $openingHours)
					           <li>{{ ucfirst(trans($day)) }}: {{ $openingHours }}
							@endforeach
{{-- 						@forelse($thisWeek as $day => $times)
							<li>{{ ucfirst(trans($day)) }}: {{ $times }}</li>
						@empty <li>No hours given</li>
						@endforelse
 --}}						</ul>
					</div>
				</div>
				
				@if($advertiser->categories->contains(2))
					<!-- Restaurant Info -->
					<div class="tab">
						<h4>Restaurant Info</h4>
						<div class="row">
							<div class="col-md-6">
								<ul>
									<li>Some amenity here</li>
									<li>Some amenity here</li>
									<li>Some amenity here</li>
								</ul>
							</div>
							<div class="col-md-6">
								<ul>
									<li>Some amenity here</li>
									<li>Some amenity here</li>
									<li>Some amenity here</li>
								</ul>
							</div>
						</div>
					</div>
				@endif


			</div>
		</div> <!-- End Row -->

		<!-- Map -->
		<div class="row my-2" id="map">
			<div class="col-12">
				<div class="map bg-light p-5">
					<h2>Map Here</h2>
				</div>
			</div>
		</div>

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
		<div class="row my-3 my-md-5" id="coupons">
			<div class="col-md-8 offset-md-2">
				<div class="p-3 mb-4 bg-advertiser">
					<h2 class="text-white">Coupon Block</h2>
					<p class="text-white">Lorem leberkas consectetur, quis labore in in cupidatat strip steak excepteur. T-bone tri-tip alcatra venison proident. Beef andouille frankfurter anim velit. Capicola deserunt cillum tempor incididunt ut.</p>
				</div>
				<div class="p-3 mb-4 bg-advertiser">
					<h2 class="text-white">Coupon Block</h2>
					<p class="text-white">Lorem leberkas consectetur, quis labore in in cupidatat strip steak excepteur. T-bone tri-tip alcatra venison proident. Beef andouille frankfurter anim velit. Capicola deserunt cillum tempor incididunt ut.</p>
				</div>
			</div>
		</div>

	</div> <!-- End Main Content Div -->

</div>

@endsection