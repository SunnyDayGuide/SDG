<div class="col-lg-4 col-md-6 mb-md-4 mb-3 px-md-0">
	<div class="card card-article h-100 overlay">
		@if(null !== $article->getFirstMedia('slider'))
		<div class="card-img-top">
			@include('partials._images', ['item' => $article])
		</div>
		@endif

		<div class="card-body">
			@if (!$article->subcategories->isEmpty() || !$article->categories->isEmpty())
			@include('categories._links', ['item' => $article])
			@endif
			
			<a href="{{ $article->path() }}" class="stretched-link text-decoration-none">
				<h5 class="card-title">{{ $article->title }}</h5>
			</a>
			<p class="card-text">{{ $article->blurb }}</p>
		</div>

		{{-- @if ($article->tags->count())
		<div class="card-footer">
			@include('tags._links', ['item' => $article, 'color' => 'advertiser'])
		</div>
		@endif --}}

	</div> <!-- End Card-->

</div> <!-- End Column-->