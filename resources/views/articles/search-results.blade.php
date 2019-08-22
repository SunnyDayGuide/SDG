@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
	@include('articles._slider', ['items' => $featured, 'profile' => 'full'])
</div>

@endsection

@section('content')

@include('articles._search')

<div class="container mt-5">

	<div>
		<div class="content">
			<h1>{{ $page->title }}</h1>
			<div class="fr-view">{!! $page->content !!}</div>
		</div>
	</div> <!-- End Row -->

	@if(!$articles->isEmpty())
	<section id="tripIdeas" class="tripIdeas">
		<div class="d-flex justify-content-between border-bottom border-editorial mb-3">
			<h2>Search Results</h2>
			<div>Sort by: Date?</div>
		</div>

		<div class="row article-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach ($articles as $article)
					@include('articles._card')
				@endforeach
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->

	</section>
	@endif

	@include('banners._zone1')

</div> <!-- End Content Container -->

@endsection
