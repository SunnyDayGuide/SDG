@php
if ( get_class($bucket_item) == 'App\Distributor' ) {
	$item = $bucket->distributors()->where('id', $bucket_item->id)->first();
} else $item = $bucket->advertisers()->where('id', $bucket_item->id)->first();
$notes = $item->pivot->notes;
@endphp

<div class="row no-gutters position-relative bucket-item bucket-item-print">
	<div class="col-md-4 mb-md-0">
		<a href="{{ $bucket_item->path() }}">@include('partials._images', ['item' => $bucket_item])</a>
	</div>

	<div class="col-md-8 position-static pl-md-0 d-flex flex-column">
		<div class="card-body pb-0 py-md-0 px-0 px-md-4">
			<h5 class="card-title mt-0 text-primary">
				{{ $bucket_item->name }}
			</h5>

			@include('bucket-list._place-locations', ['bucket_item' => $bucket_item])

			<div class="bucket-buttons my-4">
				@if($bucket_item->website_url)
				<div><span class="font-weight-bolder text-uppercase">Website:</span> <a class="text-reset" href="{{ $bucket_item->website_url }}" target="_blank">{{ $bucket_item->website_url }}</a></div>
				@endif

				@if($bucket_item->ticket_url)
				<div><span class="font-weight-bolder text-uppercase">Tickets:</span> <a class="text-reset" href="{{ $bucket_item->ticket_url }}" target="_blank">{{ $bucket_item->ticket_url }}</a></div>
				@endif

				@if($bucket_item->reservation_url)
				<div><span class="font-weight-bolder text-uppercase">Reservations:</span> <a class="text-reset" href="{{ $bucket_item->reservation_url }}" target="_blank">{{ $bucket_item->reservation_url }}</a></div>
				@endif

				@if($bucket_item->booking_url)
				<div><span class="font-weight-bolder text-uppercase">Book It:</span> <a class="text-reset" href="{{ $bucket_item->booking_url }}" target="_blank">{{ $bucket_item->booking_url }}</a></div>
				@endif
			</div>

			@if($notes)
			<div class="bucket-notes">
				<strong>NOTES: </strong>{{ $notes }}
			</div>
			@endif
		</div> <!-- End Card Body -->
	</div>
</div> <!-- End Row / Card -->