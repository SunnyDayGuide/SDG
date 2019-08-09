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

	@if(!$tripIdeas->isEmpty())
	<section id="tripIdeas" class="tripIdeas">
		<div class="d-flex justify-content-between border-bottom border-editorial mb-3">
			<h2>Trip Ideas</h2>
			<div>Sort by: Date?</div>
		</div>

		<div class="row article-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach ($tripIdeas as $article)
					@include('articles._card')
				@endforeach
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->

		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					{!! $tripIdeas->links() !!}
				</div>
			</div>
		</div>

	</section>
	@endif

	@include('banners._zone1')

	@if(!$visitorInfos->isEmpty())
	<section id="visitorInfo" class="visitorInfo">

		<div class="d-flex justify-content-between border-bottom border-primary mb-3">
			<h2>Visitor Info</h2>
			<div>Sort by: Date?</div>
		</div>

		<div class="row">
			<div class="col-md-9">
				@foreach ($visitorInfos as $article)
				@include('articles._cardh')
				@endforeach
			</div>

			@include('banners._zone2')

		</div> <!-- End Row-->

	</section>
	@endif

</div> <!-- End Content Container -->

@if(!$advSpotlights->isEmpty())
	<section id="advSpotlights" class="advSpotlights mt-5">
		<div class="container">
			<div class="border-bottom border-white mb-3 w-100">
				<h2>Advertiser Spotlights</h2>
			</div>

			<div class="row article-cards">
				<div class="card-deck w-100 mx-md-0 basic-slick">
					@foreach ($advSpotlights as $article)
						@include('articles._card')
					@endforeach
				</div> <!-- End Card Deck-->
			</div> <!-- End Row-->

		</div> <!-- End Ad Spot Container-->
	</section>
@endif

@endsection

@section('scripts')
<script src="{{ asset('js/functions.js') }}"/></script>


@endsection
