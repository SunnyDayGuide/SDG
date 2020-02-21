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

{{-- 					<div class="text-center mt-5">
						<a class="btn btn-lg btn-advertiser bucket-instructions text-primary font-weight-bold" href="#" role="button">Get Started! (Where should this go?)</a>
					</div>
 --}}					
				</div>
			</div>
		</div>
	</div>
	
		{{-- Share buttons --}}
	<div class="d-flex justify-content-end share mr-2 mb-3">
		<a href="#" class="text-center d-flex flex-column ml-3">
			<div class="fa-stack fa-sm">
				<i class="fas fa-circle fa-stack-2x"></i>
				<i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
			</div>
			<div class="text">Share</div>
		</a>
		<a href="#" class="text-center d-flex flex-column ml-3">
			<div class="fa-stack fa-sm">
				<i class="fas fa-circle fa-stack-2x"></i>
				<i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
			</div>
			<div class="text">Tweet</div>
		</a>
		<a href="#" class="text-center d-flex flex-column ml-3">
			<div class="fa-stack fa-sm">
				<i class="fas fa-circle fa-stack-2x"></i>
				<i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
			</div>
			<div class="text">Email</div>
		</a>
		<a href="#" class="text-center d-flex flex-column ml-3">
			<div class="fa-stack fa-sm">
				<i class="fas fa-circle fa-stack-2x"></i>
				<i class="fas fa-print fa-stack-1x fa-inverse"></i>
			</div>
			<div class="text">Print</div>
		</a>
	</div>

	<bucket-form 
		bucket-id="{{ $bucketId }}" 
		name-placeholder="{{ 'My '. $market->name . ' Trip' }}"
		start-placeholder="{{ 'Arrival Date' }}"
		end-placeholder="{{ 'Departure Date' }}"
	></bucket-form>	

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="text-center font-weight-bold text-white mb-0">Things to Do</h2>
		</div>

		<h4 class="text-center pb-5"><a href="{{ $market->path() }}/things-to-do">Add some THINGS TO DO to your Bucket!</a></h4>
	</div>

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Restaurants &amp; Dining</h2>
		</div>

		<h4 class="text-center pb-5"><a href="{{ $market->path() }}/restaurants">Add some RESTAURANTS to your Bucket!</a></h4>
	</div>

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Shopping</h2>
		</div>

		<h4 class="text-center pb-5"><a href="{{ $market->path() }}/shopping">Add some PLACES TO SHOP to your Bucket</a>!</h4>
	</div>

	@if($market->code == 'BR' || $market->code == 'SM')
	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Entertainment &amp; Shows</h2>
		</div>

		<h4 class="text-center pb-5"><a href="{{ $market->path() }}/entertainment-shows">Add some ENTERTAINMENT to your Bucket</a>!</h4>
	</div>
	@endif

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Places to Stay</h2>
		</div>

		<h4 class="text-center pb-5"><a href="{{ $market->path() }}/accommodations">Add some ACCOMMODATIONS to your Bucket!</a></h4>
	</div>

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Coupons</h2>
		</div>

		<h4 class="text-center pb-5"><a href="{{ $market->path() }}/coupons">Add some COUPONS to your Bucket!</a></h4>
	</div>


</div> <!-- End Container -->

@endsection