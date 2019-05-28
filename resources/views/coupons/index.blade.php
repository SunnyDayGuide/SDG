@extends('layouts.app')

{{-- @section('jumbotron')
	<div class="jumbotron">
		<div class="container">
			<h1 class="display-4">{{ $page->title }}</h1>
			<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
			<hr class="my-4">
			<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
			<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		</div>
	</div>
@endsection --}}

@section('jumbotron')
<div class="slider w-100">
	<div class="title">
		<div class="container">
			<h1>{{ $page->title }}</h1>
		</div>
	</div>
	{{ $mainImage }}
</div>
@endsection

@section('content')

{{-- <div class="search p-5">
	<h2 class="m-auto text-center">This is the search box</h2>
	<button class="btn btn-primary">Search</button>
</div> --}}

<div class="container my-3 my-md-5">

	<div class="content">
		<div class="fr-view">{!! $page->content !!}</div>
	</div>

	@include('coupons._category', ['category' => 'activities'])
	@include('coupons._category', ['category' => 'dining'])
	@include('coupons._category', ['category' => 'shopping'])
	@include('coupons._category', ['category' => 'entertainment'])


</div> <!-- End Content Container -->

@endsection
