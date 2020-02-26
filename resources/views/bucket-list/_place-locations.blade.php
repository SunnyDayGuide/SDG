<div class="locations">
	@foreach($bucket_item->locations as $location)
	<ul class="fa-ul">
		<li class="mb-2"><a href="{{ $location->directions }}" target="_blank" aria-label="Get directions to {{ $location->full_address }}"><span class="fa-li"><i class="fas fa-map-marker-alt fa-lg mr-2"></i></span>{!! $location->present()->card !!}</a></li>
		@isset($location->telephone)
		<li><a href="tel:{{ $location->telephone }}" aria-label="Call {{ $bucket_item->name }}"><span class="fa-li"><i class="fas fa-phone fa-lg mr-2"></i></span>{{ $location->telephone }}</a></li>
		@endisset
	</ul>
	@endforeach
</div>