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
		<div class="row">
			<div class="col">
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
