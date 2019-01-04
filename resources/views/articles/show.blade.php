@extends('layouts.app')
@section('content')

	<div class="container-fluid">
		<div class="row">
			{{ $inset }}
		</div>
		<div class="row">
			<div class="col-md-8">
				<h2>{{ $article->market->name }} {{ $article->articleType->name }}</h2>
				<h1>{{ $article->title }}</h1>
				<h5>by {{ $article->author }} on {{ $article->publish_date->toFormattedDateString() }}</h5>
			</div>
		</div> <!-- End Row -->

		<div class="row mb-4">
			<div class="col">
				@foreach($article->tags as $tag)
					<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="badge badge-secondary">{{ $tag->name }}</a>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				{{-- <img class="img-fluid mb-2" src="{{ asset($article->image) }}" alt=""> --}}
				<div>{!! $article->content !!}</div>
			</div> <!-- End Collumn -->
		</div> <!-- End Row -->
		<div class="row mt-3">
			<div class="col">
				<div class="alert alert-primary feedback">
					<h4>Was this article helpful?</h4>
					<div class="voting">
						<div class="d-inline">
							<form method="POST" action="{{ route('articles.rate', [$market->slug, $article]) }}" class="d-inline">
								@method('PATCH')
								@csrf
								<button type="submit" class="btn btn-primary">YES</button>
							</form>
						</div>

						<div class="d-inline">
							<form method="POST" action="{{ route('articles.rateno', [$market->slug, $article]) }}" class="d-inline">
								@method('PATCH')
								@csrf
								<button type="submit" class="btn btn-primary">NO</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection
