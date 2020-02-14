	<div class="card card-advertiser h-100">
		@if(null !== $bucket_item->getFirstMedia('slider'))
		<div class="card-img-top">
			@include('partials._images', ['item' => $bucket_item])
		</div>
		@endif

		<div class="card-body">
			<h5 class="card-title"><a href="{{ $bucket_item->path() }}" class="text-decoration-none">{{ $bucket_item->name }}</a></h5>
			
			<div class="locations">
				@foreach($bucket_item->locations as $location)
				<ul class="fa-ul">
					<li class="mb-3"><a href="{{ $location->directions }}" target="_blank" aria-label="Get directions to {{ $location->full_address }}"><span class="fa-li"><i class="fas fa-map-marker-alt fa-lg mr-2"></i></span>{!! $location->present()->card !!}</a></li>
					@isset($location->telephone)
					<li><a href="tel:{{ $location->telephone }}" aria-label="Call {{ $bucket_item->name }}"><span class="fa-li"><i class="fas fa-phone fa-lg mr-2"></i></span>{{ $location->telephone }}</a></li>
					@endisset
				</ul>
				@endforeach
			</div>

			<div class="d-flex justify-content-between align-items-end">
				<div class="web-buttons mt-2">
				@if($bucket_item->website_url)
				<a class="btn btn-advertiser mr-1" href="{{ $bucket_item->website_url }}" target="_blank" role="button">Website</a>
				@endif

				@if($bucket_item->ticket_url)
				<a class="btn btn-advertiser mr-1" href="{{ $bucket_item->ticket_url }}" target="_blank" role="button">Tickets</a>
				@endif

				@if($bucket_item->reservation_url)
				<a class="btn btn-advertiser mr-1" href="{{ $bucket_item->reservation_url }}" target="_blank" role="button">Reservations</a>
				@endif

				@if($bucket_item->booking_url)
				<a class="btn btn-advertiser mr-1" href="{{ $bucket_item->booking_url }}" target="_blank" role="button">Book It</a>
				@endif
			</div>

			<a class="text-light" v-on:click="removeItem">
				<i class="far fa-trash-alt fa-lg" title="remove"></i>
			</a>
			</div>

		</div> <!-- End Card Body-->

	</div> <!-- End Card-->
