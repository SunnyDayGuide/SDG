@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
			<h2>{{ $article->market->name }} {{ $article->articleType->name }}</h2>
			<h1>{{ $article->title }}</h1>
			<h5>by {{ $article->author }} on {{ $article->published_at->toFormattedDateString() }}</h5>
			</div>
		</div> <!-- End Row -->
		<div class="row">
			<div class="col-md-8">
				<img class="img-fluid mb-2" src="{{ asset($article->image) }}" alt="">
				<div>{{ $article->content }}</div>
			</div> <!-- End Collumn -->
		</div> <!-- End Row -->
		<div class="row mt-3">
			<div class="col">
				<div class="alert alert-primary feedback">
					<h4>Was this article helpful?</h4>
					<div class="voting">
						<a class="voting-upvote enabled" rel="nofollow" role="button" data-direction="up" data-type="post" data-nonce="599c4d2ed2" data-id="1475" data-allow="1" data-display="standard" href="#">
							<i class="fas fa-check-square"></i>
							<span>Yes</span>
						</a>
						<a class="voting-downvote enabled" rel="nofollow" role="button" data-direction="down" data-type="post" data-nonce="599c4d2ed2" data-id="1475" data-allow="1" data-display="standard" href="#">
							<i class="hkb-upvote-icon"></i>
							<span>No</span>
						</a>
					</div>
				</div>
				<h4>Was this article helpful?</h4>
				<form method="POST" action="{{ route('articles.rate', [$market->slug, $article]) }}">
					@method('PATCH')
					@csrf
					<button type="submit" class="btn btn-primary">YES</button>
				</form>
				<form method="POST" action="{{ route('articles.rateno', [$market->slug, $article]) }}">
					@method('PATCH')
					@csrf
					<button type="submit" class="btn btn-primary">NO</button>
				</form>
			</div>
		</div>
	</div>

@endsection
