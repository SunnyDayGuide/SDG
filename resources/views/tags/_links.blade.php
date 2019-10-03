<div class="tags-links text-lowercase">
	<i class="fas fa-tag mr-1 text-{{ $color }}" aria-hidden="true" title="Tags"></i>
	@foreach($item->tags as $tag)
		<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="text-reset">{{ $tag->name }}</a>{{ $loop->last ? '' : ',' }}
	@endforeach
</div>