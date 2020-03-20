<div class="row no-gutters card-h card-article overlay position-relative mb-3 mb-md-5">
	<div class="col-md-6 mb-md-0">
		<a href="{{ $article->path() }}">@include('partials._images', ['item' => $article, 'profile' => 'sm-card'])</a>
	</div>

	<div class="col-md-6 position-static pl-md-0 d-flex flex-column">
		<div class="card-body">
			@if(count($article->categories) > 0)
			@include('categories._links', ['item' => $article])
			@endif
			<h5 class="card-title mt-0"><a href="{{ $article->path() }}" class="text-decoration-none">{{ $article->title }}</a></h5>
			<p class="card-text">{{ $article->blurb }}</p>
		</div>

		<div class="card-footer">
			<a href="{{ $article->path() }}" class="btn btn-editorial btn-sm">Read More</a>
		</div>

	</div>

</div>