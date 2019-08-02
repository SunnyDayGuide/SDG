@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ $page->pivot->title }}</h1>
				{{-- <h2>{{ $subcategory->name }}</h2> --}}
				<img src="{{ asset($page->pivot->image) }}" class="img-fluid" alt="{{ $page->pivot->title }}">
				<div class="mt-4">
					<p>{{ $page->pivot->body }}</p>
				</div>
			</div>	
		</div> <!-- End Row -->

		<hr>

		@if($premierAdvertisers->count() > 0)
		<div class="row featured my-3">
			<div class="col-md-12">
				<h2>Featured {{ $category->name }}</h2>
				@foreach($premierAdvertisers as $advertiser)
					<div>
						<h3><a href="{{ $advertiser->path() }}">{{ $advertiser->name }}</a></h3>
					</div>
				@endforeach
			</div>
		</div>
		@endif

		<div class="row my-3">
			<div class="col-md-12">
				<h2>{{ $category->name }} Listings</h2>
				@foreach($advertisers as $advertiser)
					<div>
						<h3><a href="{{ $advertiser->path() }}">{{ $advertiser->name }}</a></h3>
					</div>
				@endforeach
			</div>
		</div>

	</div>

		<!-- Related Articles Section -->
	<section class="panel related-articles mt-5">
		<div class="container">

			<div class="border-bottom border-white mb-3 w-100">
				<h2>You May Also Be Interested In</h2>
			</div>

			<div class="row article-cards">
				<div class="card-deck w-100 mx-md-0">
					@foreach ($articles as $article)
						@include('articles._card')
					@endforeach
				</div> <!-- End Card Deck-->
			</div> <!-- End Row-->			

		</div>
	</section> <!-- End Related Articles Section -->

@endsection
