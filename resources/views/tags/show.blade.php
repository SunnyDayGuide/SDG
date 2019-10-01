@extends('layouts.app')

@section('jumbotron')
<div class="slider empty-jumbo gradient w-100">
	<div class="container vh-center">
		<h1 class="display-3 text-white text-center">Tag: {{ $tag->name }}</h1>
	</div>
	
</div>
@endsection

@section('content')

<!-- Tag Listings Section -->
<div class="container my-3 my-md-5">
	<!--Advertisers Section -->
	@if(count($advertisers) > 0)
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

	@include('banners._zone1')

	<!--Articles Section -->
	@if(count($articles) > 0)
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h2 class="display-4">Articles</h2>
			@foreach($articles as $article)
			@include('articles._listing')
			@endforeach
		</div>
	</div>
	@endif
	<!--End Articles Section -->

	@include('banners._zone1')

	<!--Events Section -->
	@if(count($events) > 0)
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h2 class="display-4">Events</h2>
			@foreach($events as $event)
			@include('events._listing')
			@endforeach
		</div>
	</div>
	@endif
	<!--End Events Section -->

</div> <!-- End Container -->
<!-- End Advertiser Listings Section -->

@endsection

