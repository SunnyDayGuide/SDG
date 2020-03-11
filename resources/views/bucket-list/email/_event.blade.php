@php
$item = $bucket->events()->where('id', $event->id)->first();
$notes = $item->pivot->notes;
@endphp
<div class="bucket-item">
<h3>{{ $event->title }}</h3>

<div style="text-transform: uppercase; font-weight: bolder; ">
{{ $event->dateRange }}
</div>

<div class="my-3">
{!! $event->description !!}
@if($event->location || $event->phone)
<p>
@if($event->location)<strong>Location: </strong>{{ $event->location }}
@endif
@if($event->phone)<strong>Phone: </strong>{{ $event->phone }}
@endif
</p>
@endif
</div>

@if($event->website_url)
<div class="my-3">
<a class="button button-green" href="{{ $event->website_url }}" target="_blank" role="button">More Info</a>
</div>
@endif

@if($notes)
<div class="my-3">
<strong>NOTES: </strong>{{ $notes }}
</div>
@endif
</div>