@php
$collectionName = $collectionName ?? 'slider';
$profile = $profile ?? 'card';
foreach ($items as $item) {
	$image = $item->getFirstMedia($collectionName);
}
@endphp

<div id="slider" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		@foreach($items as $item)
	      <li data-target="#slider" data-slide-to="{{ $loop->index }}" class="indictator {{ $loop->first ? 'active' : '' }}"></li>
	   @endforeach
	</ol>
	<div class="carousel-inner" role="listbox">
		@foreach($items as $item)
			<div class="carousel-item {{ $loop->first ? 'active' : '' }}">

				<a href="{{ $item->path() }}">
					@php
					$image = $item->getFirstMedia($collectionName)
					@endphp
					{{ $image($profile) }}

					<div class="carousel-caption">
						<div class="title">
							<div>
								<h4>{{ $item->title }}</h4>
								<p class="d-none d-md-block">{{ $item->excerpt }}</p>
							</div>
						</div>
					</div>
				</a>

			</div>
		@endforeach
	</div>
</div>