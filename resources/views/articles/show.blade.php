@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
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
	
	<!-- Main Content Section -->
	<section class="container mt-3 mt-md-5">
		<div class="row">
			<div class="col-md-8 offset-md-2">

				<div class="header mb-4">
					<div class="storytype">
						{{ $article->market->name }} {{ $article->articleType->name }}
					</div>
					<h1 class="article-title">{{ $article->title }}</h1>
					<div class="meta">
						@if($article->author)
						<div class="meta-byline">by {{ $article->author }}</div>
						@endif
						<time class="meta-time">{{ $article->publish_date->format('F j, Y g:ia') }}</time>
					</div>
				</div>
				
				<div class="excerpt mb-4">
					{{ $article->excerpt }}
				</div>

				<div class="content mb-4">
					<div class="fr-view">{!! $content !!}</div>
				</div>


				@if(!$article->tags->isEmpty())
				@include('tags._links', ['item' => $article, 'color' => 'advertiser'])
				@endif				

			</div> <!-- End Column -->
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

	</section>  <!-- End Main Content -->

	<!-- Premier Advertiser Section -->
	<section class="panel panel-advertisers mt-5">
		<div class="container">

			<div class="border-bottom border-white mb-3 w-100">
				<h2>{{ $market->name }} Highlights</h2>
			</div>

			<div class="row">
				<div class="card-deck w-100 mx-md-0">
					@foreach ($premierAdvertisers as $advertiser)
						@include('panels._advertisers')
					@endforeach
				</div> <!-- End Card Deck-->
			</div> <!-- End Row-->

		</div>
	</section> <!-- End Premier Advertiser Section -->
	
	<!-- Related Articles Section -->
	<section class="panel panel-articles mt-5">
		<div class="container">

			<div class="border-bottom border-white mb-3 w-100">
				<h2>You May Also Be Interested In</h2>
			</div>

			<div class="row">
				<div class="card-deck w-100 mx-md-0">
					@foreach ($relatedArticles as $relatedArticle)
						@include('panels._articles')
					@endforeach
				</div> <!-- End Card Deck-->
			</div> <!-- End Row-->			

		</div>
	</section> <!-- End Related Articles Section -->

@endsection
