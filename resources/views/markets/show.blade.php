@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
			<h1>{{ $market->name }}</h1>
			</div>
			<ul>
				@foreach ($market->categories as $category)
				<li>{{ $category->name }}</li>
				@endforeach
			</ul>
		</div> <!-- End Row -->
		<div class="row">
			@foreach ($market->articles as $article)
			<div class="col-lg-4">
				<div class="card mb-4">
					<img class="card-img-top" src="{{ $article->image }}" alt="">
					<div class="card-body">
						<h5 class="card-title">{{ $article->title }}</h2>
						<p>Published: {{ $article->updated_at->diffForHumans() }}</p>
						<p class="card-text">{{ $article->excerpt }}</p>
						<a href="{{ $article->path() }}" class="btn btn-primary">Read More</a>
						<p>{{ $article->market->name }} {{ $article->articleType->name }}</p>
					</div> <!-- End Card Body-->
				</div> <!-- End Card -->
			</div> <!-- End Column -->
			@endforeach
		</div> <!-- End Row -->
	</div>

@endsection
