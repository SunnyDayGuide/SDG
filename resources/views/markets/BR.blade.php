@extends('layouts.app')

@section('jumbotron')
@include('markets._jumbotron')
@endsection

@section('content')

<div class="container">
	<!-- First Content Section -->
	<section class="my-3 my-md-5">
		<div class="row">
			<div class="col-md-8 offset-md-2">

				<div class="header mb-4">
					<h2>The heart of the mid-west is a perfect get-away destination</h2>
				</div>

				<div class="content mb-4">
					<div class="fr-view">
						<p>Welcome to Branson, Missouri! Everything you could want for a fabulous vacation can be found here—exciting activities, entertaining shows, gourmet meals, unique shopping opportunities, and even a dancing fountain.</p>
						<p>The city is probably most famous for its many shows that are hosted in grand theaters with more seats available for spectators than in all of New York City. Bring your family and friends for a performance that will leave you laughing, singing, or even dancing in the aisles. You can choose to see magicians, comedians, concerts and tribute bands, or original acts and circus stunts.</p>
						<p>But that’s not all Branson is famous for… Located in the foothills of the Ozarks and surrounded by Table Rock Lake and Lake Taneycomo, outdoor adventures await intrepid explorers. Ever visit a cave or go on a hunt for Bigfoot? Well, you can do that here! Maybe go hiking in the hills or zip-line over them—your choice! Plus there are many exciting things to do on the water including boat tours on yachts and paddleboats, paddleboarding, jet skiing, and so much more.</p>
					</div>
				</div>

			</div> <!-- End Column -->
		</div> <!-- End Row -->

	</section>  <!-- End First Content -->

	<!-- Categories Section -->
	<section class="my-3">
		<h2 class="mb-0 font-weight-bold text-center bg-highlight text-white p-2">Discover {{ $market->name }} Blah blah blah</h2>
		<div class="card-columns">
			<div class="card text-white overlay text-left">
				<img src="{{ asset('images/branson/home/entertainment-inset.jpg') }}" class="card-img" alt="...">
				<div class="card-img-overlay">
					<a href="{{ $market->path().'/entertainment' }}" class="stretched-link text-reset text-decoration-none">
						<h3 class="card-title">Entertainment & Shows</h3>
					</a>
					<p class="card-text">Chicken ribeye swine leberkas hamburger jerky.</p>
				</div>
			</div>	
			<div class="card text-white overlay text-left">
				<img src="{{ asset('images/branson/home/activities-inset.jpg') }}" class="card-img" alt="...">
				<div class="card-img-overlay">
					<a href="{{ $market->path().'/things-to-do' }}" class="stretched-link text-reset text-decoration-none">
						<h3 class="card-title">Things to Do</h3>
					</a>
					<p class="card-text">This is one short blurb about Activities.</p>
				</div>
			</div>
			<div class="card text-white overlay text-right">
				<img src="{{ asset('images/branson/home/shopping-inset.jpg') }}" class="card-img" alt="...">
				<div class="card-img-overlay d-flex flex-column justify-content-end">
					<a href="{{ $market->path().'/shopping' }}" class="stretched-link text-reset text-decoration-none">
						<h3 class="card-title">Shopping</h3>
					</a>
					<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
				</div>
			</div>
			<div class="card text-white overlay text-left">
				<img src="{{ asset('images/branson/home/events-inset.jpg') }}" class="card-img" alt="...">
				<div class="card-img-overlay">
					<a href="{{ route('events', $market) }}" class="stretched-link text-reset text-decoration-none">
						<h3 class="card-title">Events</h3>
					</a>
					<p class="card-text">Chicken ribeye swine leberkas hamburger jerky.</p>
				</div>
			</div>
			<div class="card text-white overlay text-left">
				<img src="{{ asset('images/branson/home/dining-inset.jpg') }}" class="card-img" alt="...">
				<div class="card-img-overlay">
					<a href="{{ $market->path().'/restaurants' }}" class="stretched-link text-reset text-decoration-none">
						<h3 class="card-title">Restaurants</h3>
					</a>
					<p class="card-text">Chicken ribeye swine leberkas hamburger jerky.</p>
				</div>
			</div>
		</div>
	</section>

	@include('banners._zone1')

	<!-- Second Content Section -->
	<section class="my-3 my-md-5">
		<div class="row">
			<div class="col-md-8 offset-md-2">

				<div class="header mb-4">
					<h2>Some other Header</h2>
				</div>

				<div class="content mb-4">
					<div class="fr-view">
						<p>Throughout Branson, stop by some of the attractions that are always a ton of fun. Silver Dollar City mixes the pioneering spirit of the region with thrilling roller coasters, rides and games. Get a glimpse of the past at the Shepherd of the Hills Outdoor Theatre through the dramatization of Harold Bell Wright’s novel. There are also zoos, mountain coasters, museums and other family-friendly activities including mini-golf or racetracks.</p>
						<p>Make the most of your vacation in the Show-Me-State. We have show schedules, money-saving coupons, maps, and area features with insider information that will help you along the way and make you feel right at home in Branson.</p>
					</div>
				</div>

			</div> <!-- End Column -->
		</div> <!-- End Row -->

	</section> <!-- End Second Content -->

	<!-- Featured Articles Section -->
	@include('markets._articles')
	<!-- End Featured Articles Section -->

	@include('banners._zone3')

	<!-- Featured Section -->
	<section class="my-3 my-md-5">
		<h2>Featured Events</h2>

		<div class="row no-gutters">

			<div class="col-md-9">
				<div class="row no-gutters">
					@foreach($events as $event)
					<div class="col-md-4 mx-0">
						<div class="card overlay overlay-dark bg-dark text-white border-0">
							@if(null !== $event->getFirstMedia('inset'))
							@include('partials._images', ['collectionName' => 'inset', 'profile' => 'overlay-card', 'item' => $event])
							@endif
							<div class="card-img-overlay">
								<p class="card-text">{{ $event->dateRange }}</p>
								<h5 class="card-title">{{ $event->title }}</h5>

								<p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>

								@if($event->start_time)
								<p class="card-text"><i class="far fa-clock"></i> {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->start_time)->format('g:ia') }}@if($event->end_time) - {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->end_time)->format('g:ia') }}@endif</p>
								@endif

							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>

			<div class="col-md-3">
				<div class="bg-highlight h-100 p-2">
					<p class="text-white">Calendar Here</p>
					<a href="{{ route('events', $market) }}" class="btn btn-primary btn-nav mt-3">See All Events</a>
				</div>
			</div>

		</div>
	</section>

</div>  <!-- End Container -->

<!-- Premier Advertisers Section-->
@if(!$premierAdvertisers->isEmpty())
<section id="advSpotlights" class="panel panel-advertisers mt-5">
	<div class="container">
		<div class="border-bottom border-white mb-3 w-100">
			<h2>Advertiser Spotlights</h2>
		</div>

		<div class="row">
			<div class="card-deck w-100 mx-md-0 basic-slick">
				@foreach ($premierAdvertisers as $advertiser)
				@include('panels._advertisers')
				@endforeach
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->

	</div> 
</section> 
@endif  <!-- End Premier Advertisers Section-->


@endsection

@section('scripts')
<script src="{{ asset('js/functions.js') }}"/></script>
@endsection
