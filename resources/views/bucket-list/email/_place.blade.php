@php
if ( get_class($bucket_item) == 'App\Distributor' ) {
$item = $bucket->distributors()->where('id', $bucket_item->id)->first();
} else $item = $bucket->advertisers()->where('id', $bucket_item->id)->first();
$notes = $item->pivot->notes;
@endphp
<div class="bucket-item">
<h3><a href="{{ config('app.url') . $bucket_item->path() }}">{{ $bucket_item->name }}</a></h3>

<div class="locations my-3">
@foreach($bucket_item->locations as $location)
<ul>
<li><a href="{{ $location->directions }}" target="_blank" aria-label="Get directions to {{ $location->full_address }}">{{ $location->full_address }}</a></li>
@isset($location->telephone)
<li><a href="tel:{{ $location->telephone }}" aria-label="Call {{ $bucket_item->nam }}">{{ $location->telephone }}</a></li>
@endisset
</ul>
@endforeach
</div>

@if($bucket_item->website_url || $bucket_item->ticket_url || $bucket_item->reservation_url || $bucket_item->booking_url)
<div class="my-3">
@if($bucket_item->website_url)
<a class="button button-green" href="{{ $bucket_item->website_url }}" target="_blank" role="button">Website</a>
@endif
@if($bucket_item->ticket_url)
<a class="button button-green" href="{{ $bucket_item->ticket_url }}" target="_blank" role="button">Tickets</a>
@endif
@if($bucket_item->reservation_url)
<a class="button button-green" href="{{ $bucket_item->reservation_url }}" target="_blank" role="button">Reservations</a>
@endif
@if($bucket_item->booking_url)
<a class="button button-green" href="{{ $bucket_item->booking_url }}" target="_blank" role="button">Book It</a>
@endif
</div>
@endif

@if($notes)
<div class="my-3">
<strong>NOTES: </strong>{{ $notes }}
</div>
@endif
</div>