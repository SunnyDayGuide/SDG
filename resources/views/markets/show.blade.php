@extends('layouts.app')

@section('jumbotron')
@include('markets._jumbotron')
@endsection

@section('content')

<div class="container">
	<!-- First Content Section -->
	<section class="my-3 my-md-5">
		<div class="row">
			<div class="col-md-8 offset-md-2">

				@include('markets.'.$market->code.'._content1')

			</div> <!-- End Column -->
		</div> <!-- End Row -->

	</section>  <!-- End First Content -->

	<!-- Featured Categories Section -->
	<section id="featured-categories" class="my-3">
		@include('markets.'.$market->code.'._categories')
	</section>

	@include('banners._zone1')

	<!-- Second Content Section -->
	<section class="my-3 my-md-5">
		<div class="row">
			<div class="col-md-8 offset-md-2">

				@include('markets.'.$market->code.'._content2')

			</div> <!-- End Column -->
		</div> <!-- End Row -->

	</section> <!-- End Second Content -->

	<!-- Featured Articles Section -->
	@include('markets._articles')
	<!-- End Featured Articles Section -->

	@include('banners._zone3')

	<!-- Featured Events Section -->
	@include('markets._events')
	<!-- End Featured Events Section -->

</div>  <!-- End Container -->

<!-- Premier Advertisers Section-->
@if(!$premierAdvertisers->isEmpty())
@include('panels._premier-advertisers', ['premierAdvertisers' => $premierAdvertisers, 'slick' => true])
@endif  
<!-- End Premier Advertisers Section-->

@endsection

@section('scripts')
<script src="{{ asset('js/functions.js') }}"/></script>
@endsection
