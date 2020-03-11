@php
$item = $bucket->shows()->where('id', $show->id)->first();
$notes = $item->pivot->notes;
@endphp
<div class="bucket-item">
<h3>{{ $show->name }}</h3>

<div class="locations my-3">
<p>{{ $show->theater->name }}</p>
<ul>
<li><a href="{{ $show->theater->directions }}" target="_blank" aria-label="Get directions to {{ $show->theater->name }}">{{ $show->theater->full_address }}</a></li>
@isset($show->local_phone)
<li><a href="tel:{{ $show->local_phone }}" aria-label="Call {{ $show->name }}">{{ $show->local_phone }}</a></li>
@endisset
</ul>
</div>


<div class="my-3">
<a class="button button-green" href="{{ config('app.url') . $show->path() }}" target="_blank" role="button">Show Schedule</a>
@if($show->website_url)<a class="button button-green" href="{{ $show->website_url }}" target="_blank" role="button">Website</a>@endif
</div>


@if($notes)
<div class="my-3">
<strong>NOTES: </strong>{{ $notes }}
</div>
@endif
</div>