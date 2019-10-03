@php
$categories = $item->subcategories()->get()->groupBy('parent_id');
@endphp
<div class="category-links text-muted font-weight-bolder text-uppercase small">
@foreach ($categories as $parent_id => $subcategories)
@if($subcategories->first()->parent)
	<a href="{{ $market->path().'/'.$subcategories->first()->parent->slug }}" class="text-reset">{{ $market->name }} {{ $subcategories->first()->parent->name }}</a>
@endif
{{ $loop->last ? '' : ' / ' }}
@endforeach
</div>