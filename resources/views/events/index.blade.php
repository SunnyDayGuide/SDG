@extends('layouts.app')

@section('jumbotron')
@include('partials._jumbo-slider')
@endsection

@section('content')

<div class="search p-5">
	<h2 class="m-auto text-center">This is the search box</h2>
</div>

<div class="container mt-5">

	<div>
		<div>
			<h1>{{ $market->name }}, {{ $market->state->name }} Events</h1>
		</div>
	</div> <!-- End Row -->

	<div>
		<button type="button" class="btn btn-highlight text-white float-right">Submit an Event</button>
	</div>

	<div class="col-sm-8 offset-sm-2 p-2">
	@foreach($events as $event)
		<div class="d-flex bg-editorial my-4 p-2 text-white">
			<div class="p-2 flex-grow-1">
				<p class="event-title">{{ $event->title }}</p>
				<p class="event-date">{{ $event->dateRange }}</p>
				<p class="event-description">{{ $event->description }}</p>
			</div>
			@if(null !== $event->getFirstMedia('inset'))
				<div class="p-2">
					@include('partials._images', ['collectionName' => 'inset', 'item' => $event])
				</div>
			@endif
		</div>
	@endforeach
	</div>

</div>

@endsection