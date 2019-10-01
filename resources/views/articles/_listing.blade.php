<div class="border-bottom mb-3">
	@php
	$categories = $article->subcategories()->get()->groupBy('parent_id');
	@endphp
	@foreach ($categories as $parent_id => $subcategories)
	@if($subcategories->first()->parent)
	<div class="text-muted font-weight-bolder text-uppercase d-inline small">
		<a href="{{ $market->path().'/'.$subcategories->first()->parent->slug }}" class="text-reset">{{ $market->name }} {{ $subcategories->first()->parent->name }}</a>
	</div>
	@endif
	{{ $loop->last ? '' : ' / ' }}
	@endforeach
	<h5 class="text-advertiser card-title mb-0"><a href="{{ $article->path() }}" class="text-reset">{{ $article->title }}</a></h5>
	<time>{{ $article->publish_date->diffForHumans() }}</time>
	<div class="mt-0"><p>{!! $article->excerpt !!}</p></div>
</div>