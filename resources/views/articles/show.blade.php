@extends('layouts.app')

@section('jumbotron')
<div class="article-slider w-100">
	{{-- If there is more than one image, render a slider --}}
	@if($slides->count() > 1)
	<div id="slider" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach($slides as $slide)
		      <li data-target="#slider" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
		   @endforeach
		</ol>
		<div class="carousel-inner" role="listbox">
			@foreach($slides as $slide)
				<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
					{{ $slide('full') }}
				</div>
			@endforeach
		</div>
	</div>

	{{-- Otherwise just spit out a single image --}}
	@else
	{{ $image }}

	@endif

</div>
@endsection

@section('content')

	<div class="container mt-5">
		<div class="row">
			<div class="col-12">
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
				<div class="fr-view">{!! $article->content !!}</div>
			</div> <!-- End Collumn -->
		</div> <!-- End Row -->
		
		<div class="row mt-3">
			<div class="col">
				<div class="alert alert-editorial feedback">
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
