@extends('layouts.app')

@section('jumbotron')
@include('partials._jumbo-slider')
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

	@if(!$visitorInfos->isEmpty())
	<section id="visitorInfo" class="visitorInfo">
		<div class="d-flex justify-content-between border-bottom border-editorial mb-3">
			<h2>Trip Ideas</h2>
			<div>Sort by: Date?</div>
		</div>

		<div class="row article-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach ($visitorInfos as $article)
					@include('articles._card')
				@endforeach
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->

	</section>
	@endif

	@include('banners._zone1')

</div> <!-- End Content Container -->

	<!--Advertisers Section -->
	@if(!$advertisers->isEmpty())
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h2 class="display-4">Places to Go</h2>
			@foreach($advertisers as $advertiser)
			@include('advertisers._listing')
			@endforeach
		</div>
	</div>
	@endif
	<!--End Advertisers Section -->

@endsection

@section('scripts')
<script src="{{ asset('js/functions.js') }}"/></script>


@endsection
