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
