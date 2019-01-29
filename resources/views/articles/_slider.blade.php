@php
$collectionName = $collectionName ?? 'slider';
$profile = $profile ?? 'card';
@endphp

<div id="carouselIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		@foreach($featured as $feature)
	      <li data-target="#carouselIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
	   @endforeach
	</ol>
	<div class="carousel-inner" role="listbox">
		@foreach($featured as $feature)
			<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
				{{ $feature->getFirstMedia($collectionName) }}
				<div class="carousel-caption d-none d-md-block">
					<h1>{{ $feature->title }}</h1>
					<p>{{ $feature->excerpt }}</p>
				</div>
			</div>
		@endforeach
	</div>
</div>