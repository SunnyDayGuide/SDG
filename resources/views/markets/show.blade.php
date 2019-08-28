@extends('layouts.app')

@section('jumbotron')
<div class="mkt-home slider w-100">
	<div class="slider-header">
		<h1>Welcome to <br><span class="name">{{ $market->name }}, {{ $market->state->abbr }}!</span></h1>
	</div>
	<!-- Carousel -->
	<div id="carouselIndicators" class="carousel slide mb-2" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach($sliderImages as $image)
			<li data-target="#carouselIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
			@endforeach
		</ol>
		<div class="carousel-inner" role="listbox">
			@foreach($sliderImages as $image)
			<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
				{{ $image('full') }}
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col">
				<div class="jumbotron">
				  <h1 class="display-4">Welcome to {{ $market->name }}, {{ $market->state->name }}!</h1>
				  <p class="lead">Here lies some market specific slide show or something. You are on the {{ $market->code }} home page</p>
				  <hr class="my-4">
				  <p>It might list the market's cities like this: {{ $market->cities }} if they exist</p>
				  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
				</div>
			</div>
		</div> <!-- End Row -->

		<div class="row">
			<div class="col">
				<h2>Featured Articles</h2>
				<div class="row">
					@include('articles._featured')
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<h2>Featured Events</h2>
			</div>
		</div>
	</div> <!-- End Container -->

@endsection
