@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
			<h2>{{ $article->market->name }} {{ $article->articleType->name }}</h2>
			<h1>{{ $article->title }}</h1>
			<h5>by {{ $article->author }} on {{ $article->published_at->diffForHumans() }}</h5>
			</div>
		</div> <!-- End Row -->
		<div class="row">
			<div class="col-md-8">
				<img class="img-fluid mb-2" src="{{ $article->image }}" alt="">
				<div>{{ $article->content }}</div>
			</div> <!-- End Collumn -->
		</div> <!-- End Row -->
	</div>

@endsection
