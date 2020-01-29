<div class="col-md-6">
	<h4>About the Property</h4>
	<ul class="list-unstyled">
		@if($place->present()->property_location)
		<li><span class="amenity">{{ $place->present()->property_location }}</span>
		</li>
		@endif

		@if($place->isCampground())
			@if($place->present()->campground_services)
			@foreach($place->present()->campground_services as $amenity)
			<li>{!! $amenity !!}</li>
			@endforeach
			@endif
		@endif

		<li><span class="amenity">Pet Friendly</span>{{ $place->pet_friendly ? 'Yes' : 'No' }}</li>
		
		@if(!$place->isCampground())
			@if($place->present()->property_services)
			@foreach($place->present()->property_services as $amenity)
			<li>{!! $amenity !!}</li>
			@endforeach
			@endif
		@endif
	</ul>
</div>

<div class="col-md-6">
	<h4>Services &amp; Amenities</h4>
	<ul class="list-unstyled">
		@if($place->present()->property_amenities)
		@foreach($place->present()->property_amenities as $amenity)
		<li>{!! $amenity !!}</li>
		@endforeach
		@endif
	</ul>
</div>