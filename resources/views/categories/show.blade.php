@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ $lead->pivot->title }}</h1>
				{{-- <h2>{{ $subcategory->name }}</h2> --}}
				<img src="{{ asset($lead->pivot->image) }}" class="img-fluid" alt="{{ $lead->pivot->title }}">
				<div class="mt-4">
					<p>{{ $lead->pivot->body }}</p>
				</div>
			</div>	
		</div> <!-- End Row -->

		<hr>

		<div class="row mt-5 bg-light">
			<div class="col-md-12">
				<h2>Related Articles</h2>
				<div class="row">
					@include('articles._featured')
				</div>
			</div>
		</div> <!-- End Row -->

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

@endsection
