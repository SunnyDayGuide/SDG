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

	<div class="bucket-form mb-3">
		<form action="POST">
			@csrf
			<div class="form-row">
				<div class="form-group col-md-6">
					<input type="text" name="name" class="form-control form-control-lg bucket-name" placeholder="My {{ $market->name }} Trip">
				</div>

				<div class="form-group col-md-3">
					<div class="input-group date">
						<input type="text" class="form-control form-control-lg" id="start_date" name="start_date" placeholder="Arrival Date">
						<div class="input-group-append">
							<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
						</div>
					</div>
				</div>

				<div class="form-group col-md-3">
					<div class="input-group date">
						<input type="text" class="form-control form-control-lg" id="end_date" name="end_date" placeholder="Departure Date">
						<div class="input-group-append">
							<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="text-center font-weight-bold text-white mb-0">Things to Do</h2>
		</div>
		
		@if($activities->count() == 0)
		<h4 class="text-center pb-5"><a href="{{ $market->path() }}/things-to-do">Add some THINGS TO DO to your Bucket!</a></h4>
		@endif

		<div class="row advertiser-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach($activities as $activity)
				<bucket-item item-id="{{ $activity->id }}" item-class="Advertiser" v-slot="{removeItem}" div-class="col-md-4 mb-md-4 mb-3 px-md-0">
					@include('bucket-list._card', ['bucket_item' => $activity])
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

		<div class="row advertiser-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach($restaurants as $restaurant)
				<bucket-item item-id="{{ $restaurant->id }}" item-class="Advertiser" v-slot="{removeItem}" div-class="col-md-4 mb-md-4 mb-3 px-md-0">
					@include('bucket-list._card', ['bucket_item' => $restaurant])
				</bucket-item>
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

		<div class="row advertiser-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach($shops as $shop)
				<bucket-item item-id="{{ $shop->id }}" item-class="Advertiser" v-slot="{removeItem}" div-class="col-md-4 mb-md-4 mb-3 px-md-0">
					@include('bucket-list._card', ['bucket_item' => $shop])
				</bucket-item>
				@endforeach
			</div>
		</div>

	</div>

	@if($market->code == 'BR' || $market->code == 'SM')
	<div class="bucket-section mb-5">
		<div class="bucket-header py-2 bg-editorial mb-4">
			<h2 class="flex-grow-1 text-center font-weight-bold text-white mb-0">Entertainment &amp; Shows</h2>
		</div>

		@if($entertainers->count() == 0 && $shows->count() == 0)
		<h4 class="text-center pb-5"><a href="{{ $market->path() }}/entertainment-shows">Add some ENTERTAINMENT to your Bucket</a>!</h4>
		@endif

		<div class="row advertiser-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach($entertainers as $entertainer)
				<bucket-item item-id="{{ $entertainer->id }}" item-class="Advertiser" v-slot="{removeItem}" div-class="col-md-4 mb-md-4 mb-3 px-md-0">
					@include('bucket-list._card', ['bucket_item' => $entertainer])
				</bucket-item>
				@endforeach
			</div>
		</div>

{{-- 		@foreach($entertainers as $entertainer)
		<div class="row bucket-item border-bottom border-light mb-4">
			<div class="col-md-10 offset-md-1">
				@include('bucket-list._card', ['bucket_item' => $entertainer])
			</div>
		</div>
		@endforeach
		--}}
		@foreach($shows as $show)
		<div class="row bucket-item border-bottom border-light mb-4">
			<div class="col-md-10 offset-md-1">
				{{-- @include('bucket-list._show') --}}
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

		<div class="row advertiser-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach($accommodations as $accommodation)
				@if(get_class($accommodation) == 'App\Advertiser')
				<bucket-item item-id="{{ $accommodation->id }}" item-class="Advertiser" v-slot="{removeItem}" div-class="col-md-4 mb-md-4 mb-3 px-md-0">
					@include('bucket-list._card', ['bucket_item' => $accommodation])
				</bucket-item>
				@else
				<bucket-item item-id="{{ $accommodation->id }}" item-class="Distributor" v-slot="{removeItem}" div-class="col-md-4 mb-md-4 mb-3 px-md-0">
					@include('bucket-list._card2', ['bucket_item' => $accommodation])
				</bucket-item>
				@endif
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

		@foreach($coupons as $coupon)
		<div class="row bucket-item">
			<bucket-item item-id="{{ $coupon->id }}" item-class="Coupon" v-slot="{removeItem}" div-class="col-md-8 offset-md-2">
				@include('bucket-list._coupon')
			</bucket-item>
		</div>
		@endforeach
	</div>

</div> <!-- End Container -->

@endsection

@section('scripts')
<script src="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
	$('#start_date').datepicker({
		autoclose: true,
		todayBtn: "linked",
		orientation: "auto"
	});  
	$('#end_date').datepicker({
		autoclose: true,
		todayBtn: "linked",
		orientation: "auto"
	});  
</script> 
@endsection