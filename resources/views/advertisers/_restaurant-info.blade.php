<div class="col-md-6">
	<h4>Restaurant Info</h4>
	<ul class="list-unstyled">
		@if($advertiser->present()->meals)
		<li><span class="amenity">Serves</span>
			{{ $advertiser->present()->meals }}
		</li>
		@endif

		@if($advertiser->present()->reservations)
		<li><span class="amenity">Reservations</span>
			{{ $advertiser->present()->reservations }}
		</li>
		@endif
		
		@if($advertiser->present()->amenities)
		@foreach($advertiser->present()->amenities as $amenity)
		<li>{!! $amenity !!}</li>
		@endforeach
		@endif
	</ul>

	@foreach($menus as $menu)
	<a class="btn btn-advertiser text-white" href="{{ url($menu->file) }}" target="_blank" role="button">View Menu {{ $loop->count <= 1 ? '' : $loop->iteration }}</a>
	@endforeach

</div>