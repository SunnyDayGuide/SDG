<div class="border-bottom mb-3">
	@include('categories._links', ['item' => $article])
	<h5 class="text-advertiser card-title mb-0"><a href="{{ $article->path() }}" class="text-reset">{{ $article->title }}</a></h5>
	{!! $article->present()->publishedDiff !!}
	<div class="mt-0"><p>{{ $article->excerpt }}</p></div>
</div>