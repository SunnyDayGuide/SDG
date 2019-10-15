@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
	@include('articles._slider', ['items' => $featured, 'profile' => 'full'])
</div>

@endsection

@section('content')

<div class="container my-3 my-md-5">
	<div class="content">
		<div class="page-title">
			<h1 class="display-4">{{ $page->title }}</h1>
		</div>

		<div class="fr-view page-body">
			{!! $page->content !!}
		</div>
	</div>
</div>

<section class="panel panel-white">
	<div class="container">
		<div class="text-center">
			<h2 class="font-weight-bold">Articles and Features</h2>
		</div>

		@include('articles._search')

		@if(!$tripIdeas->isEmpty())
		<div class="row article-cards">
			<div class="card-deck w-100 mx-md-0">
				@foreach ($tripIdeas as $article)
					@include('articles._card')

					@if($loop->iteration % 12 == 0)
					<div class="col-12 mb-md-4 mb-3 px-md-0">
						@include('banners._zone1')
					</div>
					@endif

				@endforeach

				@if($tripIdeas->count() < 12)
				<div class="col-12 mb-md-4 mb-3 px-md-0">
					@include('banners._zone1')
				</div>
				@endif

			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->

		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					{!! $tripIdeas->links() !!}
				</div>
			</div>
		</div>
		@endif

	</div>
</section>

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
