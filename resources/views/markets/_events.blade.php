<section class="my-3 my-md-5">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="d-flex justify-content-between border-bottom border-light">
				<h2>Events This Week</h2>
				<div class="d-flex align-items-center mr-md-2 mb-2">
					<a href="{{ route('events', $market) }}" class="btn btn-highlight">See All Events</a>
				</div>
			</div>
			
			<div class="scrollarea pr-3 mr-3 mt-4">
				@foreach($events as $event)
				@include('events._listing')
				@endforeach
			</div>
		</div>
	</div>

</section>