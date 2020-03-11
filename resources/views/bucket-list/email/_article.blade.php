@php
$item = $bucket->articles()->where('id', $article->id)->first();
$notes = $item->pivot->notes;
@endphp
<div class="bucket-item">
<h3>{{ $article->title }}</h3>

<div class="my-3">
{{ $article->present()->excerpt }}
</div>

<div class="my-3">
<a class="button button-green" href="{{ config('app.url') . $article->path() }}" target="_blank" role="button">Read More</a>
</div>

@if($notes)
<div class="my-3">
<strong>NOTES: </strong>{{ $notes }}
</div>
@endif
</div>