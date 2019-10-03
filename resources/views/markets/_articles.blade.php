<section class="my-3 my-md-5 panel market-home">

	<div class="border-bottom border-white mb-3 w-100">
		<h2 class="font-weight-bold text-center text-highlight">What's Hot in {{ $market->name }}</h2>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="card card-article overlay primary-article">
				@if(null !== $latestArticle->getFirstMedia('slider'))
				<div class="card-img-top">
					<a href="{{ $latestArticle->path() }}">@include('partials._images', ['item' => $latestArticle, 'profile' => 'card'])</a>
				</div>
				@endif

				<div class="card-body">
					@include('categories._links', ['item' => $latestArticle])
					<a href="{{ $latestArticle->path() }}" class="text-reset text-decoration-none">
						<h5 class="card-title">{{ $latestArticle->title }}</h5>
					</a>
					<p class="card-text">{{ $latestArticle->excerpt }}</p>

				</div>

				<div class="card-footer text-center pb-md-0">
					<a href="{{ $latestArticle->path() }}" class="btn btn-highlight btn-lg btn-block">Read More</a>
				</div>

			</div> <!-- End Card-->
		</div> <!-- End Column-->

		<div class="col-md-6 d-flex flex-column justify-content-between">
			@foreach ($latestArticles as $article)
			<div class="row no-gutters card-h card-article overlay position-relative">
				<div class="col-md-6 mb-md-0">
					<a href="{{ $article->path() }}">@include('partials._images', ['item' => $article, 'profile' => 'sm-card'])</a>
				</div>

				<div class="col-md-6 position-static pl-md-0 d-flex flex-column">
					<div class="card-body py-md-0">
						@include('categories._links', ['item' => $article])
						<h5 class="card-title mt-0"><a href="{{ $article->path() }}" class="text-reset text-decoration-none">{{ $article->title }}</a></h5>
						<p class="card-text d-md-none">{{ $article->blurb }}</p>
					</div>

					<div class="card-footer">
						<a href="{{ $article->path() }}" class="btn btn-editorial btn-sm">Read More</a>
					</div>

				</div>

			</div>
			@endforeach
		</div> <!-- End Column-->
	</div> <!-- End Row-->			

</section>