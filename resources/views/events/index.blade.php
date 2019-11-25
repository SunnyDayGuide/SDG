@extends('layouts.app')

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

	<div class="content">
		<div class="page-title d-md-flex justify-content-between">
			<h1 class="display-4">{{ $page->title }}</h1>
			<div class="d-flex align-items-center mr-md-2">
				<a href="{{ route('events.create', $market) }}" class="btn btn-highlight text-white float-right">Submit an Event</a></div>
			</div>

			<div class="fr-view page-body">
				{!! $page->content !!}
			</div>
		</div>

		<div class="col-sm-8 offset-sm-2">
			@foreach($events as $event)
			<div class="event-container my-4">
				<div class="row">
					<div class="col-2">
						<div class="event-dates">
							{{ $event->date_range }}
						</div>
					</div>

					<div class="event-info col-10">
						<a class="text-reset text-decoration-none d-flex" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
							<div class="pr-2 ml-n3 carat"><i class="fas fa-chevron-down font-weight-bold text-editorial"></i></div>
							<div class="event-text">
								<h5 class="event-title">{{ $event->title }}</h5>
								<p class="event-location">
									@if($event->start_time)<i class="fas fa-clock fa-fw" aria-hidden="true"></i><span class="start-time">{!! $event->present()->start_time !!}</span>@endif
									@if($event->end_time)<span class="end-time">{!! $event->present()->end_time !!}</span>@endif
									<i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i><span class="mr-2">{{ $event->location }}</span>
								</p>
							</div>
						</a>
					</div>
				</div> <!-- End Row -->

				<div class="row no-gutters collapse mr-0" id="collapseExample">
					<div class="col-md-2"></div>
					<div class="col-md-10 event-details p-3">
						<div class="fr-view event-description text-white">{!! $event->description !!}</div>
						<div class="event-buttons d-flex justify-content-between">
							<a href="#">Bucket</a>
							<div class="buttons">
								@if($event->facebook_url)<a class="event-fb text-light" href="{{ $event->facebook_url }}" target="_blank"><span class="fa-stack fa-2x"><i class="fas fa-circle fa-stack-2x"></i><i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i></span></a>@endif
								@if($event->ticket_url)<a class="btn btn-primary" href="{{ $event->ticket_url }}" target="_blank">Buy Tickets</a>@endif
								@if($event->website_url)<a class="btn btn-primary" href="{{ $event->website_url }}" target="_blank">Website</a>@endif
							</div>
						</div>
					</div>
				</div>

			</div> <!-- End Event Container -->
			@endforeach
		</div>

	</div>

	@endsection