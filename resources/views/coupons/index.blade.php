@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
	{{ $mainImage }}
</div>
@endsection

@section('content')

<div class="container my-3 my-md-5">

	<div class="content">
		<h1 class="display-4">{{ $page->title }}</h1>
		<div class="fr-view">{!! $page->content !!}</div>
	</div>

	@include('coupons._category', ['category' => 'activities'])
	@include('coupons._category', ['category' => 'dining'])
	@include('coupons._category', ['category' => 'shopping'])
	@include('coupons._category', ['category' => 'entertainment'])

</div> <!-- End Container -->

@endsection
