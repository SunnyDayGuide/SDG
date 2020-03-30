@extends('layouts.app')

@section('styles')
<link href="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('jumbotron')
@include('partials._jumbo-slider')
@endsection

@section('content')

<div class="container my-3 my-md-5">

	@if (session('message'))
	<div class="alert alert-editorial" role="alert">
		{{ session('message') }}
	</div>
	@endif

	<div class="page-header mb-md-5">

		<div class="page-title d-md-flex justify-content-between">
			<h1 class="display-4">{{ $page->title }}</h1>
		</div>

		<div class="fr-view content">{!! $page->content !!}</div>

		<div class="d-md-flex justify-content-end my-3">
			<div class="d-flex align-items-center mr-5">
				<div class="bucket-instructions text-primary font-weight-bold mr-3 text-right">Add Event to your Bucket List <i class="fas fa-arrow-right"></i></div>
				<div class="bucket-btn"><span class="icon-bucket position-relative text-primary"><span class="bucket-items"><i class="fas fa-plus-circle text-white"></i></span></span></div>
			</div>
			<div class="d-flex align-items-center mr-md-2">
				<a href="{{ route('events.create', $market) }}" class="btn btn-highlight text-white float-right">Submit an Event</a>
			</div>
		</div>

	</div>

	<div class="panel panel-light py-3 py-md-5 px-md-5">
		<div class="container">
			<h2 class="text-center font-weight-bold text-primary mb-md-3">Filter {{ $market->name }} Events</h2>
			@include('events._search')
		</div>
	</div>
	
	<div class="row panel py-3 py-md-5 px-md-5">
		<div class="col-sm-8 offset-sm-2">
			@foreach($groupedEvents as $key => $events)
			<h3>{{ $key }}</h3>
				@foreach($events as $event)
				<div class="event-container my-4">
					<div class="row mx-0">

						<div class="col-3">
							<div class="event-dates float-right"  data-toggle="collapse" href="#event_{{ $event->id }}" role="button" aria-expanded="false" aria-controls="event_{{ $event->id }}">
								<span class="event-start text-center">
									<em class="date">{{ $event->start_date->day }}</em>
									<em class="month">{{ $event->start_date->formatLocalized('%b') }}</em>
								</span>
								@if($event->end_date && ($event->end_date != $event->start_date))
								<span class="event-end text-right">
									<em class="date">{{ $event->end_date->day }}</em>
									<em class="month">{{ $event->end_date->formatLocalized('%b') }}</em>
								</span>
								@endif
								<em class="clearfix"></em>
							</div>
						</div>

						<div class="event-info col-9">
							<a class="text-reset text-decoration-none d-flex" data-toggle="collapse" href="#event_{{ $event->id }}" role="button" aria-expanded="false" aria-controls="event_{{ $event->id }}">
								<div class="pr-2 ml-n3 carat"><i class="fas fa-chevron-down font-weight-bold text-editorial"></i></div>
								<div class="event-text">
									<h5 class="event-title">{{ $event->title }}</h5>
									<p class="event-location">
										@if($event->start_time)<i class="fas fa-clock fa-fw" aria-hidden="true"></i><span class="start-time">{!! $event->present()->start_time !!}</span>@endif
										@if($event->end_time)<span class="end-time">{!! $event->present()->end_time !!}</span>@endif
										<i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i><span class="mr-2">{{ $event->location }}</span>
									</p>
									@if($event->recurrences->count())
									<p>{{ $event->rrule }}</p>
									@endif
								</div>
							</a>
						</div>
					</div> <!-- End Row -->

					<div class="row no-gutters collapse mr-0" id="event_{{ $event->id }}">
						<div class="col-3"></div>
						<div class="col-9 event-details p-3">
							<div class="fr-view event-description text-white">{!! $event->description !!}</div>
							<div class="event-buttons d-flex justify-content-between align-items-center">

								@include('partials._bucket-button', ['item' => $event, 'button' => 'icon'])

								<div class="buttons d-flex align-items-center">
									@if($event->facebook_url)<a class="text-white ml-2" href="{{ $event->facebook_url }}" target="_blank"><i class="fab fa-facebook fa-2x"></i></span></a>@endif
									@if($event->ticket_url)<a class="btn btn-white text-editorial ml-4" href="{{ $event->ticket_url }}" target="_blank">Buy Tickets</a>@endif
									@if($event->website_url)<a class="btn btn-white text-editorial ml-2" href="{{ $event->website_url }}" target="_blank">Website</a>@endif
								</div>
							</div>
						</div>
					</div>

				</div> <!-- End Event Container -->
				@endforeach
			@endforeach
		</div>
	</div>

</div> <!-- End Container -->

@endsection

@section('scripts')
<script src="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
	$('.event_date').datepicker({
		autoclose: true,
		todayBtn: "linked",
		orientation: "auto"
	});  
</script> 
@endsection