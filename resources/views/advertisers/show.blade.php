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
						<div class="d-md-flex flex-wrap align-items-center"> 
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

							<div class="social">
								@if($advertiser->facebook)
									<a href="{{ $advertiser->facebook }}" target="_blank" class="rounded-circle bg-light text-white social-item fb" aria-label="View {{ $advertiser->name }} Facebook page"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
								@endif
								@if($advertiser->instagram)
									<a href="{{ $advertiser->instagram }}" target="_blank" class="rounded-circle bg-light text-white social-item ig" aria-label="View {{ $advertiser->name }} Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
								@endif
								@if($advertiser->twitter)
									<a href="{{ $advertiser->twitter }}" target="_blank" class="rounded-circle bg-light text-white social-item" aria-label="View {{ $advertiser->name }} Twitter feed"><i class="fab fa-twitter" aria-hidden="true"></i></a>
								@endif
								@if($advertiser->youtube)
									<a href="{{ $advertiser->youtube }}" target="_blank" class="rounded-circle bg-light text-white social-item yt" aria-label="View {{ $advertiser->name }} YouTube channel"><i class="fab fa-youtube" aria-hidden="true"></i></a>
								@endif
								@if($advertiser->pinterest)
									<a href="{{ $advertiser->pinterest }}" target="_blank" class="rounded-circle bg-light text-white social-item" aria-label="View {{ $advertiser->name }} Pinterest feed"><i class="fab fa-pinterest" aria-hidden="true"></i></a>
								@endif
							</div>

						</div> <!-- End Web & social buttons -->
						
					</div>
					<div class="w-25 ml-3 d-none d-md-block">{{ $logo }}</div>
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
				<div class="fr-view write-up">{!! $advertiser->write_up !!}</div>

				<div class="my-3">
					@foreach($advertiser->tags as $tag)
						<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
					@endforeach
				</div>

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
			<button id="show-map" class="vh-center btn btn-lg btn-primary">Show Map</button>
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

</div>

@endsection

@section('scripts')
@includeWhen(count($locations) == 1, 'advertisers._map')
@includeWhen(count($locations) > 1, 'advertisers._map2')
@endsection