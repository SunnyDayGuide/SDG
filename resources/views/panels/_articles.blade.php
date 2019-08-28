<div class="col-lg-4 col-md-6 mb-md-4 mb-3 px-md-0">
		<div class="card card-article h-100 overlay">
			@if(null !== $relatedArticle->getFirstMedia('slider'))
			<div class="card-img-top">
				@include('partials._images', ['item' => $relatedArticle])
			</div>
			@endif

			<div class="card-body">
				<a href="{{ $relatedArticle->path() }}" class="stretched-link text-reset text-decoration-none"><h5 class="card-title">{{ $relatedArticle->title }}</h5></a>
				<p class="card-text">{{ $relatedArticle->blurb }}</p>
			</div>

			@if ($relatedArticle->tags->count())
			<div class="card-footer">
				@foreach($relatedArticle->tags as $tag)
				<a href="{{ $relatedArticle->market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
				@endforeach
			</div>
			@endif

		</div> <!-- End Card-->

</div> <!-- End Column-->