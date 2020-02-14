<div class="mkt-home slider w-100">
	<div class="slider-header px-3">
		<h1>Welcome to <br><span class="name">{{ $market->name }}, {{ $market->state->name }}!</span></h1>
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