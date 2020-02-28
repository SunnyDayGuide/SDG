<div class="row bucket-item bucket-item-print">
	<div class="card-body p-0">
		<h5 class="text-primary card-title mb-0">{{ $event->title }}</h5>

		<div class="text-muted font-weight-bolder text-uppercase d-inline">
			<i class="fas fa-calendar-day fa-fw mr-1"></i>{{ $event->dateRange }}
		</div>

		<div class="mt-2">
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
		
		@if($event->website_url)
		<div class="events-links my-3">
			<div><span class="font-weight-bolder text-uppercase">More Info:</span> <a class="text-reset" href="{{ $event->website_url }}" target="_blank">{{ $event->website_url }}</a></div>
		</div>
		@endif

		<div class="bucket->notes">
			{{ $notes }}
		</div>
	</div>
</div>