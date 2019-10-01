<div class="border-bottom mb-3">
	<h5 class="text-advertiser card-title mb-0">{{ $event->title }}</h5>
	<div class="text-muted font-weight-bolder text-uppercase d-inline">
		<i class="fas fa-calendar-day fa-fw mr-1"></i>{{ $event->dateRange }}
	</div>
	<div class="mt-0">
		{!! $event->description !!}
		@if($event->location || $event->phone)
		<p>
			@if($event->location)<i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i><span class="mr-2">{{ $event->location }}</span>
			@endif
			@if($event->phone)<i class="fas fa-phone fa-fw" aria-hidden="true"></i>{{ $event->phone }}
			@endif
		</p>
		@endif
	</div>
	<div class="events-links my-3"><a href="{{ $event->website_url }}" target="_blank" class="btn btn-highlight btn-sm">More Info</a></div>
</div>