@php
$subcategories = $item->subcategories()->get()->groupBy('parent_id');
$categories = $item->supercategories()->get();
@endphp
<div class="category-links text-muted font-weight-bolder text-uppercase small">
	@if($item->subcategories())
		@foreach ($subcategories as $parent_id => $subcategories)
		@if($subcategories->first()->parent)
			<a href="{{ $item->market->path().'/'.$subcategories->first()->parent->slug }}" class="text-reset">{{ $item->market->name }} {{ $subcategories->first()->parent->name }}</a>
		@endif
		{{ $loop->last ? '' : ' / ' }}
		@endforeach
	@endif
	@if($item->supercategories())
		@foreach ($categories as $category)
			<a href="{{ $item->market->path().'/'.$category->slug }}" class="text-reset">{{ $item->market->name }} {{ $category->name }}</a>
		{{ $loop->last ? '' : ' / ' }}
		@endforeach
	@endif
</div>