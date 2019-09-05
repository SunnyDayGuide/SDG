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