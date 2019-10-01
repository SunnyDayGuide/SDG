<div class="border-bottom mb-3">
	@php
	$categories = $advertiser->subcategories()->get()->groupBy('parent_id');
	@endphp
	@foreach ($categories as $parent_id => $subcategories)
	@if($subcategories->first()->parent)
	<div class="text-muted font-weight-bolder text-uppercase d-inline small">
		<a href="{{ $market->path().'/'.$subcategories->first()->parent->slug }}" class="text-reset">{{ $market->name }} {{ $subcategories->first()->parent->name }}</a>
	</div>
	@endif
	{{ $loop->last ? '' : ' / ' }}
	@endforeach
	<h5 class="text-advertiser card-title mb-0"><a href="{{ $advertiser->path() }}" class="text-reset">{{ $advertiser->name }}</a></h5>
	<div class="mt-0">{!! $advertiser->write_up !!}</div>
</div>