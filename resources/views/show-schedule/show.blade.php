@extends('layouts.app')

@section('content')

<!-- Main Content -->
<div class="container my-3 my-md-5">
	<div class="row">
		<div class="col-md-8 offset-md-2">

			<!-- Header -->
			<div class="mb-3"> 
				<h1>{{ $show->name }}</h1>

				<!-- Web & social buttons -->
				<div> 
					<div class="web-buttons mr-3 mb-2 mb-md-0">
						@if($show->theater)
						<a class="btn btn-advertiser text-white mr-1" href="#show-map" role="button">Map</a>
						@endif

						@if($show->website_url)
						<a class="btn btn-advertiser text-white" href="{{ $show->website_url }}" target="_blank" role="button">Website</a>
						@endif
					</div>
				</div> <!-- End Web buttons -->
			</div>

		</div> <!-- End Column -->
	</div> <!-- End Row -->

	<!-- Map -->
	@if($show->theater)
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

	<!-- Theater -->
	<div class="row mt-4">
		<div class="col-md-8 offset-md-2 locations">
			<h5 class="mb-0">{{ $show->theater->name }}</h5>
			<div class="d-md-flex justify-content-between border-bottom border-light mb-4">
				<div class="flex-grow-1 py-1">
					<a href="{{ $show->theater->directions }}" target="_blank" aria-label="Get directions to {{ $show->theater->name }}">
						<i class="fas fa-map-marker-alt fa-lg fa-fw mr-2" aria-hidden="true"></i>{{ $show->theater->full_address }}
					</a>
				</div>
				@isset($show->local_phone)
				<div class="py-1">
					<a href="tel:{{ $show->local_phone }}" aria-label="Call {{ $show->name }}">
						<i class="fas fa-phone fa-lg fa-fw mr-2" aria-hidden="true"></i>{{ $show->local_phone }}
					</a>
					@isset($show->toll_free)
					 <a href="tel:{{ $show->toll_free }}" aria-label="Call {{ $show->name }}">Call Toll-Free: {{ $show->toll_free }}</a>
					@endisset
				</div>
				@endisset
			</div>
		</div>
	</div>
	@endif

	<!-- Bucket button -->
	<div class="row">
		<div class="col-md-8 offset-md-2">
			@include('partials._bucket-button', ['item' => $show, 'button' => 'button'])
		</div>
	</div>

	<!-- Schedule -->
	<div id="show-schedule" class="row my-4">
		<div class="col-md-8 offset-md-2">
			<div id="{{ $show->gadget->gadget_slug }}"></div>
			<script src="https://calendars.branson.com/js/2.1/calendar.js" type="application/javascript"></script>
			@include('show-schedule._schedule')
		</div>
	</div>
	
</div> <!-- End Main Content Div -->

@endsection

@section('scripts')
{{-- <script src="https://calendars.branson.com/js/2.1/calendar.js" type="application/javascript"></script> --}}
{{-- <script src="{{ asset('js/show-schedule.js') }}"/></script>
<script type="application/javascript">
	var slug = '{{ $show->gadget->gadget_slug }}';
	var div = document.createElement('div');
	div.setAttribute('class', 'inside');

	var BransonCalendar = new BransonCalendarWidget(slug, 'green');

	div.innerHTML = BransonCalendar.display();
	console.log(div.innerHTML)
	document.getElementById(slug).appendChild(div);
</script> --}}

@include('show-schedule._initMap')
@endsection