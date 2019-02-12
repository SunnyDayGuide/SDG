@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<div class="row py-3 py-md-5">
		<div class="col-md-8 offset-md-2">

			<!-- Header -->
			<div class="d-flex mb-3"> 
				<div class="flex-grow-1">
					<h1>{{ $advertiser->name }}</h1>

					<!-- Web & social buttons -->
					<div class="d-flex align-items-center"> 
						<div class="web-buttons mr-3">
							@if($advertiser->website_url)
								<a class="btn btn-advertiser text-white" href="{{ $advertiser->website_url }}" target="_blank" role="button">Website</a>
							@endif
							@if($advertiser->ticket_url)
								<a class="btn btn-sm btn-advertiser" href="{{ $advertiser->ticket_url }}" target="_blank" role="button">Tickets</a>
							@endif
							@if($advertiser->reservation_url)
								<a class="btn btn-sm btn-advertiser" href="{{ $advertiser->reservation_url }}" target="_blank" role="button">Reservations</a>
							@endif
							@if($advertiser->booking_url)
								<a class="btn btn-sm btn-advertiser" href="{{ $advertiser->booking_url }}" target="_blank" role="button">Book It</a>
							@endif
						</div>

						<div class="social">
							@if($advertiser->facebook)
								<a href="{{ $advertiser->facebook }}" class="rounded-circle bg-light text-white social-item fb"><i class="fab fa-facebook-f"></i></a>
							@endif
							@if($advertiser->instagram)
								<a href="{{ $advertiser->instagram }}" class="rounded-circle bg-light text-white social-item ig"><i class="fab fa-instagram"></i></a>
							@endif
							@if($advertiser->twitter)
								<a href="{{ $advertiser->twitter }}" class="rounded-circle bg-light text-white social-item"><i class="fab fa-twitter"></i></a>
							@endif
							@if($advertiser->youtube)
								<a href="{{ $advertiser->youtube }}" class="rounded-circle bg-light text-white social-item yt"><i class="fab fa-youtube"></i></a>
							@endif
							@if($advertiser->pinterest)
								<a href="{{ $advertiser->pinterest }}" class="rounded-circle bg-light text-white social-item"><i class="fab fa-pinterest"></i></a>
							@endif
						</div>

					</div> <!-- End Web & social buttons -->
					
				</div>
				<div class="w-25 ml-auto d-none d-md-block">{{ $logo }}</div>
			</div>

			<!-- Carousel -->
			<div id="carouselIndicators" class="carousel slide mb-2 mb-md-3" data-ride="carousel">
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
			<div class="d-flex flex-wrap align-items-baseline justify-content-end mb-3">
				<div class="mr-md-2 mb-2 mb-md-0">
					@foreach($advertiser->categories as $category)
						<a href="{{ $market->path().'/'.$category->slug }}" class="text-decoration-none advertiser-cat">{{ $category->name }}</a>
					@endforeach
				</div>
				<div>
					@foreach($advertiser->tags as $tag)
						<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white ml-2 tags">{{ $tag->name }}</a>
					@endforeach
				</div>
			</div>

			<div class="fr-view">{!! $advertiser->write_up !!}</div>

		</div>
	</div> <!-- End Row -->

</div>

@endsection