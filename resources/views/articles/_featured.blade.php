@foreach ($articles as $article)
<div class="col-lg-4 card-deck">
	<div class="card mb-4">
		<img class="card-img-top" src="{{ asset($article->image) }}" alt="">
		<div class="card-body">
			<h5 class="card-title">{{ $article->title }}</h2>
			<p>Published: {{ $article->publish_date->diffForHumans() }}</p>
			<p class="card-text">{{ $article->excerpt }}</p>
			<a href="{{ $article->path() }}" class="btn btn-primary">Read More</a>
			<p>{{ $article->market->name }} {{ $article->articleType->name }}</p>
		</div> <!-- End Card Body-->
		@if ($article->tags->count())
		<div class="card-footer">
			@foreach($article->tags as $tag)
			<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="badge badge-secondary">{{ $tag->name }}</a>
			@endforeach
		</div>
		@endif
	</div> <!-- End Card -->
</div> <!-- End Collumn -->
@endforeach