@foreach ($articles as $article)
<div class="col-lg-4 card-deck">
	<div class="card card-article mb-4">
		<img class="card-img-top" src="{{ asset($article->image) }}" alt="">
		<div class="card-body">
			@if ($article->subcategories->count())
			@include('categories._links', ['item' => $article])
			@endif

			<h2 class="card-title">{{ $article->title }}</h2>
			<p>{!! $article->present()->published_at !!}</p>
			<p class="card-text">{{ $article->present()->excerpt }}</p>
			<a href="{{ $article->path() }}" class="btn btn-primary">Read More</a>
			<p>{{ $article->market->name }} {{ $article->articleType->name }}</p>
		</div> <!-- End Card Body-->
		
		@if ($article->tags->count())
		<div class="card-footer">
			@include('tags._links', ['item' => $article, 'color' => 'advertiser'])
		</div>
		@endif
	</div> <!-- End Card -->
</div> <!-- End Collumn -->
@endforeach