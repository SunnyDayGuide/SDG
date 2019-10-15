<section class="my-3 my-md-5">
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h2>Events This Week</h2>
			<div class="row no-gutters">

				<div class="col-md-8">
					<div class="row no-gutters">
						<div class="scrollarea pr-3 mr-3">
						@foreach($events as $event)
						@include('events._listing')
						@endforeach
						</div>
					</div>
				</div>

				<div class="col-md-4 mt-2">
					<div class="bg-highlight h-100 p-2">
						<a href="{{ route('events', $market) }}" class="btn btn-primary btn-nav mt-3">See All Events</a>
					</div>
				</div>

			</div>
		</div>
	</div>

</section>