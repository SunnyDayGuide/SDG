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