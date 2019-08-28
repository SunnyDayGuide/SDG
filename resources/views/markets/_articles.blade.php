<section class="my-3 my-md-5 market-home">

	<div class="border-bottom border-white mb-3 w-100">
		<h2 class="font-weight-bold text-center text-highlight">What's Hot in {{ $market->name }}</h2>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="card card-article overlay primary-article">
				@if(null !== $latestArticle->getFirstMedia('slider'))
				<div class="card-img-top">
					@include('partials._images', ['item' => $latestArticle, 'profile' => 'card'])
				</div>
				@endif

				<div class="card-body">
					<a href="{{ $latestArticle->path() }}" class="stretched-link text-reset text-decoration-none">
						<h5 class="card-title">{{ $latestArticle->title }}</h5>
					</a>
					<p class="card-text">{{ $latestArticle->excerpt }}</p>

				</div>

				<div class="card-footer text-center">
					<a href="{{ $latestArticle->path() }}" class="btn btn-highlight btn-lg btn-block">Read More</a>
				</div>

			</div> <!-- End Card-->
		</div> <!-- End Column-->

		<div class="col-md-6">
			@foreach ($latestArticles as $article)
			<div class="row no-gutters card-h card-article overlay position-relative mb-md-4">
				<div class="col-md-6 mb-md-0">
					@include('partials._images', ['item' => $article, 'profile' => 'sm-card'])
				</div>

				<div class="col-md-6 position-static pl-md-0">
					<div class="card-body py-md-0">
						<h5 class="card-title mt-0"><a href="{{ $article->path() }}" class="text-reset text-decoration-none stretched-link">{{ $article->title }}</a></h5>
						<p class="card-text">{{ $article->blurb }}</p>

						<div class="text-center d-md-none">
							<a href="{{ $article->path() }}" class="btn btn-editorial stretched-link">Read More</a>
						</div>
					</div>

				</div>

			</div>
			@endforeach
		</div> <!-- End Column-->
	</div> <!-- End Row-->			

</section>