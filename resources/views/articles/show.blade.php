@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
	{{-- If there is more than one image, render a slider --}}
	@if($slides->count() > 1)
	<div class="slick-single">
		@foreach($slides as $slide)
			<div class="slick-slide">
				{{ $slide('full') }}
				@if(null !== $slide->getCustomProperty('credit'))
				<div class="container">
					<div class="figure-caption text-right text-light pt-2">
						@if(null !== $slide->getCustomProperty('credit'))
						<div class="credit small">Photo courtesy of: {{ $slide->getCustomProperty('credit') }}.</div>
						@endif
					</div>
				</div>
				@endif
			</div>
		@endforeach
	</div>
{{-- 	<div id="slider" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach($slides as $slide)
		      <li data-target="#slider" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
		   @endforeach
		</ol>
		<div class="carousel-inner" role="listbox">
			@foreach($slides as $slide)
				<figure class="carousel-item {{ $loop->first ? 'active' : '' }}">
					{{ $slide('full') }}
					@if(null !== $slide->getCustomProperty('credit') || null !== $slide->getCustomProperty('caption'))
					<div class="container">
						<figcaption class="figure-caption text-right pt-2">
							@if(null !== $slide->getCustomProperty('caption'))
							<div class="caption font-italic">{{ $slide->getCustomProperty('caption') }}</div>
							@endif
							@if(null !== $slide->getCustomProperty('credit'))
							<div class="credit small">Photo courtesy of: {{ $slide->getCustomProperty('credit') }}</div>
							@endif
						</figcaption>
					</div>
					@endif
				</figure>
			@endforeach
		</div>
	</div> --}}

	{{-- Otherwise just spit out a single image --}}
	@else
	{{ $image }}
		@if(null !== $image->getCustomProperty('credit'))
		<div class="container">
			<div class="figure-caption small text-right pt-2">
				@if(null !== $image->getCustomProperty('credit'))
				<div class="credit">Photo courtesy of: {{ $image->getCustomProperty('credit') }}</div>
				@endif
			</div>
		</div>
		@endif

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
					<div class="article-meta">
						<span class="posted-on"><i class="far fa-calendar mr-1"></i>{!! $article->present()->date !!}</span>
						@if($article->author)
						<span class="byline"><i class="fas fa-user mr-1"></i>{{ $article->author }}</span>
						@endif
					</div>
				</div>
				
				{{-- <div class="excerpt mb-4">
					{{ $article->excerpt }}
				</div> --}}

				<div class="content mb-4">
					<div class="fr-view d-inline-block">{!! $content !!}</div>
				</div>
				
				<div class="d-flex align-items-center my-4">
					<!-- Bucket button -->
					@include('partials._bucket-button', ['item' => $article, 'button' => 'button'])

					@if(count($article->tags) > 0)
					<!-- Tags Links -->
					@include('tags._links', ['item' => $article, 'color' => 'advertiser'])
					@endif
				</div>
{{-- 
				@if(!$article->tags->isEmpty())
				@include('tags._links', ['item' => $article, 'color' => 'advertiser'])
				@endif	 --}}			

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
	
	@if(!$premierAdvertisers->isEmpty())
	@include('panels._premier-advertisers', ['premierAdvertisers' => $premierAdvertisers, 'slick' => false])
	@endif

	@if(!$relatedArticles->isEmpty())
	@include('panels._related-articles', ['articles' => $relatedArticles])
	@endif

@endsection


@section('scripts')
<script src="{{ asset('js/functions.js') }}"/></script>
@endsection
