<div class="col-lg-4 col-md-6 mb-md-4 mb-3 px-md-0">
	<div class="card h-100 overlay">
		@if(null !== $article->getFirstMedia('slider'))
		<div class="card-img-top">
			@include('partials._images', ['item' => $article])
		</div>
		@endif

		<div class="card-body">
			<a href="{{ $article->path() }}" class="stretched-link text-reset text-decoration-none">
				<h5 class="card-title">{{ $article->title }}</h5>
			</a>
			<p class="card-text">{{ $article->excerpt }}</p>
		</div>

		@if ($article->tags->count())
		<div class="card-footer">
			@foreach($article->tags as $tag)
			<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
			@endforeach
		</div>
		@endif

	</div> <!-- End Card-->

</div> <!-- End Column-->