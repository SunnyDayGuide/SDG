@extends('layouts.app')

@section('styles')
<link href="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="container my-3 my-md-5">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="page-header mb-md-5">
				<div class="page-title">
					<h1 class="display-4">Your Vacation Bucket List</h1>
				</div>

				<div class="content">
					<h2>REWRITE THIS TO BE GENERIC</h2>
					<p>So many options. So little time. Don't get overwhelmed by the choices. Whether you're planning a family beach trip, a romantic getaway or a weekend outing, the Ocean City Trip Planner can help you make the most out of your vacation days. Browse the incredible number of things to do in OC, add your favorite selections, sort them according to your schedule and share your itinerary with friends online.</p>

					<p>Whether you're reserving a hotel room, a restaurant table or concert tickets, remember to directly book your dates by contacting the selections in your itinerary! We've made it easy by providing phone numbers and web addresses for each listing.</p>

					<p>Look for the "Add to trip planner" icon throughout our website, for an easy way to plan your Ocean City, Maryland adventure. Just click on it, and whatever you're interested in will appear on a personalized list, below!</p>
				</div>
			</div>
		</div>
	</div>

	{{-- Share buttons --}}
	<div class="d-flex justify-content-end mr-2 mb-3">
		<social-share-button url="{{ urlencode('https://sunnyday.test/destinations/branson/bucket-list') }}" network="facebook"></social-share-button>

		<social-share-button url="{{ urlencode('https://sunnyday.test/destinations/branson/bucket-list') }}" network="twitter" message="Check out this cool way to plan your vacation!" hashtags="branson,vacation,bucketlist" via="SunnyDayGuide"></social-share-button>

		<bucket-list-email bucket="{{ $bucket->id }}"></bucket-list-email>

		<a href="{{ route('bucket-list.print') }}" class="share d-flex flex-column ml-3">
			<div class="fa-stack fa-sm">
				<i class="fas fa-circle fa-stack-2x"></i>
				<i class="fas fa-print fa-stack-1x fa-inverse"></i>
			</div>
			<div class="text">Print</div>
		</a>
	</div>

	<bucket-form 
	bucket-id="{{ $bucket ? $bucket->id : $bucketId }}" 
	name-placeholder="{{ $bucket->name ? $bucket->name : 'My '. $market->name . ' Trip' }}"
	start-placeholder="{{ $bucket->start_date ? $bucket->start_date->format('m/d/Y') : 'Arrival Date' }}"
	end-placeholder="{{ $bucket->end_date ? $bucket->end_date->format('m/d/Y') : 'Departure Date' }}"
	></bucket-form>	
	
</div> <!-- End Container -->

<section class="panel panel-light mt-5">
	<div class="container">
		<div class="bucket-section mb-5">
			<div class="bucket-header py-2 bg-editorial mb-4">
				<h2 class="text-center font-weight-bold text-white mb-0">Things to Do</h2>
			</div>

			@if($activities->count() == 0 && $events->count() == 0)
			<h4 class="text-center pb-5"><a href="{{ $market->path() }}/things-to-do">Add some THINGS TO DO to your Bucket!</a></h4>
			@endif

			<div class="row">
				<div class="col-md-10 offset-md-1">
					@foreach($activities as $activity)
					@include('bucket-list._place', ['bucket_item' => $activity])
					@endforeach
					
					@foreach($events as $event)
					@php
					$item = $bucket->events()->where('id', $event->id)->first();
					$notes = $item->pivot->notes;
					@endphp
					<bucket-item item-id="{{ $event->id }}" item-class="App\Event" card-class="card-article" item-notes="{{ $notes }}" item-completed="{{ $item->pivot->completed ? $item->pivot->completed : '0' }}">
						<template slot="body">
							@include('bucket-list._event')
						</template>
					</bucket-item>
					@endforeach

				</div>
			</div>

		</div>

		<div class="bucket-section mb-5">
			<div class="bucket-header py-2 bg-editorial mb-4">
				<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Restaurants &amp; Dining</h2>
			</div>

			@if($restaurants->count() == 0)
			<h4 class="text-center pb-5"><a href="{{ $market->path() }}/restaurants">Add some RESTAURANTS to your Bucket!</a></h4>
			@endif

			<div class="row">
				<div class="col-md-10 offset-md-1">
					@foreach($restaurants as $restaurant)
					@include('bucket-list._place', ['bucket_item' => $restaurant])
					@endforeach
				</div>
			</div>
		</div>

		<div class="bucket-section mb-5">
			<div class="bucket-header py-2 bg-editorial mb-4">
				<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Shopping</h2>
			</div>

			@if($shops->count() == 0)
			<h4 class="text-center pb-5"><a href="{{ $market->path() }}/shopping">Add some PLACES TO SHOP to your Bucket</a>!</h4>
			@endif

			<div class="row">
				<div class="col-md-10 offset-md-1">
					@foreach($shops as $shop)
					@include('bucket-list._place', ['bucket_item' => $shop])
					@endforeach
				</div>
			</div>

		</div>

		@if($market->code == 'BR' || $market->code == 'SM' || $entertainers->count() > 0 || $shows->count() > 0)
		<div class="bucket-section mb-5">
			<div class="bucket-header py-2 bg-editorial mb-4">
				<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Entertainment &amp; Shows</h2>
			</div>

			@if($entertainers->count() == 0 && $shows->count() == 0)
			<h4 class="text-center pb-5"><a href="{{ $market->path() }}/entertainment-shows">Add some ENTERTAINMENT to your Bucket</a>!</h4>
			@endif

			<div class="row">
				<div class="col-md-10 offset-md-1">
					@foreach($entertainers as $entertainer)
					@include('bucket-list._place', ['bucket_item' => $entertainer])
					@endforeach

					@foreach($shows as $show)
					@php
					$item = $bucket->shows()->where('id', $show->id)->first();
					$notes = $item->pivot->notes;
					@endphp
					<bucket-item item-id="{{ $show->id }}" item-class="App\Show" card-class="card-advertiser" item-notes="{{ $notes }}" item-completed="{{ $item->pivot->completed ? $item->pivot->completed : '0' }}">
						<template slot="body">
							<div class="card card-advertiser">
								<div class="card-body p-0">
									<h5 class="card-title mt-0">
										<a href="{{ $show->path() }}" class="text-decoration-none">{{ $show->name }}</a>
									</h5>
									<div class="locations">
										<p>{{ $show->theater->name }}</p>
										<ul class="fa-ul">
											<li class="mb-2"><a href="{{ $show->theater->directions }}" target="_blank" aria-label="Get directions to {{ $show->theater->name }}"><span class="fa-li"><i class="fas fa-map-marker-alt fa-lg mr-2"></i></span>{{ $show->theater->full_address }}</a></li>
											@isset($show->local_phone)
											<li><a href="tel:{{ $show->local_phone }}" aria-label="Call {{ $show->name }}"><span class="fa-li"><i class="fas fa-phone fa-lg mr-2"></i></span>{{ $show->local_phone }}</a>@endisset
												@isset($show->toll_free)
												<a class="ml-5" href="tel:{{ $show->toll_free }}" aria-label="Call {{ $show->name }}">Call Toll-Free: {{ $show->toll_free }}</a>
												@endisset
											</li>
										</ul>
									</div>

									<div class="bucket-buttons my-3">
										<a class="btn btn-advertiser mr-1" href="{{ $show->path() }}" target="_blank" role="button">Show Schedule</a>
										@if($show->website_url)
										<a class="btn btn-advertiser mr-1" href="{{ $show->website_url }}" target="_blank" role="button">Website</a>
										@endif
									</div>
								</div>
							</div>
						</template>
					</bucket-item>
					@endforeach
				</div>
			</div>			
		</div>
		@endif

		<div class="bucket-section mb-5">
			<div class="bucket-header py-2 bg-editorial mb-4">
				<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Places to Stay</h2>
			</div>

			@if($accommodations->count() == 0) 
			<h4 class="text-center pb-5"><a href="{{ $market->path() }}/accommodations">Add some ACCOMMODATIONS to your Bucket!</a></h4>
			@endif

			<div class="row">
				<div class="col-md-10 offset-md-1">
					@foreach($accommodations as $accommodation)
					@php
					if ( get_class($accommodation) == 'App\Advertiser' ) {
						$item = $bucket->advertisers()->where('id', $accommodation->id)->first();
					} else $item = $bucket->distributors()->where('id', $accommodation->id)->first();
					$notes = $item->pivot->notes;
					@endphp
					<bucket-item-card item-id="{{ $accommodation->id }}" item-class="{{ get_class($accommodation) }}" card-class="card-advertiser" item-notes="{{ $notes }}" item-completed="{{ $item->pivot->completed ? $item->pivot->completed : '0' }}">
						<template slot="image">
							<a href="{{ $accommodation->path() }}">@include('partials._images', ['item' => $accommodation])</a>
						</template>
						<template slot="title">
							<a href="{{ $accommodation->path() }}" class="text-decoration-none">{{ $accommodation->name }}</a>
						</template>
						<template slot="body">
							@include('bucket-list._place-locations', ['bucket_item' => $accommodation])
						</template>
						<template slot="buttons">
							@include('bucket-list._place-buttons', ['bucket_item' => $accommodation])
						</template>
					</bucket-item-card>
					@endforeach
				</div>
			</div>

		</div>

		<div class="bucket-section mb-5">
			<div class="bucket-header py-2 bg-editorial mb-4">
				<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Coupons</h2>
			</div>

			@if($coupons->count() == 0)
			<h4 class="text-center pb-5"><a href="{{ $market->path() }}/coupons">Add some COUPONS to your Bucket!</a></h4>
			@endif

			<div class="row">
				<div class="col-md-10 offset-md-1">
					@foreach($coupons as $coupon)
					@php
					$item = $bucket->coupons()->where('id', $coupon->id)->first();
					$notes = $item->pivot->notes;
					@endphp
					<bucket-item item-id="{{ $coupon->id }}" item-class="App\Coupon" card-class="card-advertiser" item-notes="{{ $notes }}" item-completed="{{ $item->pivot->completed ? $item->pivot->completed : '0' }}">
						<template slot="body">
							@include('bucket-list._coupon')
						</template>
					</bucket-item>
					@endforeach
				</div>
			</div>
		</div>

		<div class="bucket-section mb-5">
			<div class="bucket-header py-2 bg-editorial mb-4">
				<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Trip Ideas/Visitor Info.</h2>
			</div>

			@if($articles->count() == 0)
			<h4 class="text-center pb-5"><a href="{{ $market->path() }}/trip-ideas">Add some TRIP IDEAS to your Bucket!</a></h4>
			@endif
			<div class="row">
				<div class="col-md-10 offset-md-1">
					@foreach($articles as $article)
					@php
					$item = $bucket->articles()->where('id', $article->id)->first();
					$notes = $item->pivot->notes;
					@endphp
					<bucket-item-card item-id="{{ $article->id }}" item-class="App\Article" card-class="card-article" item-notes="{{ $notes }}" item-completed="{{ $item->pivot->completed ? $item->pivot->completed : '0' }}">
						<template slot="image">
							<a href="{{ $article->path() }}">@include('partials._images', ['item' => $article])</a>
						</template>
						<template slot="title">
							<a href="{{ $article->path() }}" class="text-decoration-none">{{ $article->title }}</a>
						</template>
						<template slot="body">
							<p class="card-text">{{ $article->present()->excerpt }}</p>
						</template>
						<template slot="buttons">
							<a href="{{ $article->path() }}" class="btn btn-editorial">Read More</a>
						</template>
					</bucket-item-card>
					@endforeach
				</div>
			</div>
		</div>
	</div> <!-- End Container -->
</section>

@endsection