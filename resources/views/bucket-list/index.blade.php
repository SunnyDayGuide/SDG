@extends('layouts.app')

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
	
	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="text-center font-weight-bold text-white mb-0">Things to Do</h2>
		</div>
		
		@if($activities->count() == 0)
		    <h4 class="text-center pb-5"><a href="{{ $market->path() }}/things-to-do">Add some THINGS TO DO to your Bucket!</a></h4>
		@endif

		@foreach($activities as $activity)
		<div class="row bucket-item border-bottom border-light mb-4">
			<div class="col-md-10 offset-md-1">
				<advertiser-bucket-item 
					bucket-item="{{ $activity }}" 
					route="{{ $activity->path() }}" 
					name="{{ $activity->name }}" 
					{{-- v-html:image="@include('partials._images', ['item' => $activity])"  --}}
					locations="{{ $activity->locations }}">
				</advertiser-bucket-item>
				{{-- @include('bucket-list._card', ['bucket_item' => $activity]) --}}
			</div>
		</div>
		@endforeach
	</div>

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Restaurants &amp; Dining</h2>
		</div>

		@if($restaurants->count() == 0)
		    <h4 class="text-center pb-5"><a href="{{ $market->path() }}/restaurants">Add some RESTAURANTS to your Bucket!</a></h4>
		@endif

		@foreach($restaurants as $restaurant)
		<div class="row bucket-item border-bottom border-light mb-4">
			<div class="col-md-10 offset-md-1">
				@include('bucket-list._card', ['bucket_item' => $restaurant])
			</div>
		</div>
		@endforeach
	</div>

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Shopping</h2>
		</div>

		@if($shops->count() == 0)
		    <h4 class="text-center pb-5"><a href="{{ $market->path() }}/shopping">Add some PLACES TO SHOP to your Bucket</a>!</h4>
		@endif

		@foreach($shops as $shop)
		<div class="row bucket-item border-bottom border-light mb-4">
			<div class="col-md-10 offset-md-1">
				@include('bucket-list._card', ['bucket_item' => $shop])
			</div>
		</div>
		@endforeach
	</div>
	
	@if($market->code == 'BR' || $market->code == 'SM')
	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Entertainment &amp; Shows</h2>
		</div>

		@if($entertainers->count() == 0 && $shows->count() == 0)
		    <h4 class="text-center pb-5"><a href="{{ $market->path() }}/entertainment-shows">Add some ENTERTAINMENT to your Bucket</a>!</h4>
		@endif

		@foreach($entertainers as $entertainer)
		<div class="row bucket-item border-bottom border-light mb-4">
			<div class="col-md-10 offset-md-1">
				@include('bucket-list._card', ['bucket_item' => $entertainer])
			</div>
		</div>
		@endforeach

		@foreach($shows as $show)
		<div class="row bucket-item border-bottom border-light mb-4">
			<div class="col-md-10 offset-md-1">
				@include('bucket-list._card', ['bucket_item' => $show])
			</div>
		</div>
		@endforeach
	</div>
	@endif

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Places to Stay</h2>
		</div>

		@if($accommodations->count() == 0)
		    <h4 class="text-center pb-5"><a href="{{ $market->path() }}/accommodations">Add some ACCOMMODATIONS to your Bucket!</a></h4>
		@endif

		@foreach($accommodations as $accommodation)
		<div class="row bucket-item border-bottom border-light mb-4">
			<div class="col-md-10 offset-md-1">
				@include('bucket-list._card', ['bucket_item' => $accommodation])
			</div>
		</div>
		@endforeach
	</div>

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Coupons</h2>
		</div>

		@if($coupons->count() == 0)
		    <h4 class="text-center pb-5"><a href="{{ $market->path() }}/accommodations">Add some COUPONS to your Bucket!</a></h4>
		@endif

		@foreach($coupons as $coupon)
		<div class="row bucket-item">
			<div class="col-md-8 offset-md-2">
				@include('bucket-list._coupon')
			</div>
		</div>
		@endforeach
	</div>

</div> <!-- End Container -->

@endsection