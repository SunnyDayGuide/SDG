@foreach ($articles as $article)
<div class="col-lg-4">
	<div class="card mb-4">
		<img class="card-img-top" src="{{ $article->image }}" alt="">
		<div class="card-body">
			<h5 class="card-title">{{ $article->title }}</h2>
			<p>Published: {{ $article->published_at->diffForHumans() }}</p>
			<p class="card-text">{{ $article->excerpt }}</p>
			<a href="{{ $article->path() }}" class="btn btn-primary">Read More</a>
			<p>{{ $article->market->name }} {{ $article->articleType->name }}</p>
		</div> <!-- End Card Body-->
	</div> <!-- End Card -->
</div> <!-- End Collumn -->
@endforeach