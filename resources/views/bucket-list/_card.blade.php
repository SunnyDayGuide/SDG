<div class="card card-advertiser overlay mb-4 border-0">
	<div class="row no-gutters">
		<div class="col-md-5">
			@if(null !== $bucket_item->getFirstMedia('slider'))
			<div class="card-img">
				<a href="{{ $bucket_item->path() }}">
					@include('partials._images', ['item' => $bucket_item])
				</a>
			</div>
			@endif
		</div>
		<div class="col-md-7">
			<div class="card-body py-0">
				<a href="{{ $bucket_item->path() }}" class="text-reset text-decoration-none">
					<h5 class="card-title">{{ $bucket_item->name }}</h5>
				</a>
				
				<div class="locations">
					@foreach($bucket_item->locations as $location)
					<div class="d-md-flex justify-content-between my-4">
						<div class="flex-grow-1 py-1">
							<a href="{{ $location->directions }}" target="_blank" aria-label="Get directions to {{ $location->full_address }}">
								<i class="fas fa-map-marker-alt fa-lg fa-fw mr-2" title="Get directions to {{ $location->full_address }}"></i>{{ $location->full_address }}
							</a>
						</div>
						@isset($location->telephone)
						<div class="py-1">
							<a href="tel:{{ $location->telephone }}" aria-label="Call {{ $bucket_item->name }}">
								<i class="fas fa-phone fa-lg fa-fw mr-2" title="Call {{ $bucket_item->name }}"></i>{{ $location->telephone }}
							</a>
						</div>
						@endisset
					</div>
					@endforeach
				</div>

				<div class="web-buttons my-2">
					@if(get_class($bucket_item) == 'App\Advertiser')
					@if(count($bucket_item->coupons) > 0)
					<a class="btn btn-advertiser text-white mr-1" href="{{ $bucket_item->path() }}#coupons" role="button">Coupons</a>
					@endif
					@endif

					@if($bucket_item->website_url)
					<a class="btn btn-primary mr-1" href="{{ $bucket_item->website_url }}" target="_blank" role="button">Website</a>
					@endif

					@if($bucket_item->ticket_url)
					<a class="btn btn-primary mr-1" href="{{ $bucket_item->ticket_url }}" target="_blank" role="button">Tickets</a>
					@endif

					@if($bucket_item->reservation_url)
					<a class="btn btn-primary mr-1" href="{{ $bucket_item->reservation_url }}" target="_blank" role="button">Reservations</a>
					@endif

					@if($bucket_item->booking_url)
					<a class="btn btn-primary mr-1" href="{{ $bucket_item->booking_url }}" target="_blank" role="button">Book It</a>
					@endif
				</div>

			</div>
		</div>
	</div>
</div>