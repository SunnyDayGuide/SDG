@extends('layouts.app')

@section('jumbotron')
	<div class="jumbotron">
		<div class="container">
			<h1 class="display-4">{{ $market->name }}, {{ $market->state->name }} Coupons</h1>
			<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
			<hr class="my-4">
			<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
			<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		</div>
	</div>
@endsection

@section('content')

{{-- <div class="search p-5">
	<h2 class="m-auto text-center">This is the search box</h2>
	<button class="btn btn-primary">Search</button>
</div> --}}

<div class="container my-5">

	<div class="content">
		<p>Ready to start saving money on your next Outer Banks vacation? Our coupons are conveniently divided into three categories: Activities, Dining, and Shopping. Download each section below or select ALL COUPONS above to print them all. Use the listings on this page to see all of our great deals and make the most of your vacation!</p>
	</div>

	@include('coupons._category', ['category' => 'activities'])
	@include('coupons._category', ['category' => 'dining'])
	@include('coupons._category', ['category' => 'shopping'])
	@include('coupons._category', ['category' => 'entertainment'])


</div> <!-- End Content Container -->

@endsection
