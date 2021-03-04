@extends('layouts.print')

@section('content')
<div class="container print-container">
	<div class="buttons d-print-none">
		<a href="#Print" onclick="window.print(); return false;" class="btn btn-highlight mr-2">Click to Print</a>
		<a href="#Back" class="btn btn-highlight" onClick="history.go(-1);return true;">Go Back</a>
	</div>
	
	<div class="bucket-print-header d-flex justify-content-between mt-3 mb-4">
		<div class="">
			<h1 class="text-primary">{{ $bucket->name }}</h1>
			@if($bucket->start_date && $bucket->end_date)
			<h4>{{ $bucket->start_date->format('m/d/Y') }} - {{ $bucket->end_date->format('m/d/Y') }}</h4>
			@endif
		</div>
		<div class="print-brand">
			<img src="{{ asset('storage/images/main/SDG-header-logo.svg') }}" alt="Sunny Day Guide logo">
		</div>
	</div>
	
	@if($activities->count() > 0 || $events->count() > 0)
	<div class="bucket-section mb-5">
		<h2 class="font-weight-bold mb-3">Things to Do</h2>
		@foreach($activities as $activity)
		@include('bucket-list.print._place', ['bucket_item' => $activity])
		@endforeach

		@foreach($events as $event)
		@php
		$item = $bucket->events()->where('id', $event->id)->first();
		$notes = $item->pivot->notes;
		@endphp
		@include('bucket-list.print._event')
		@endforeach
	</div>
	@endif

	@if($restaurants->count() > 0)
	<div class="bucket-section mb-5">
		<h2 class="font-weight-bold mb-3">Restaurants & Dining</h2>
		@foreach($restaurants as $restaurant)
		@include('bucket-list.print._place', ['bucket_item' => $restaurant])
		@endforeach
	</div>
	@endif

	@if($shops->count() > 0)
	<div class="bucket-section mb-5">
		<h2 class="font-weight-bold mb-3">Shopping</h2>
		@foreach($shops as $shop)
		@include('bucket-list.print._place', ['bucket_item' => $shop])
		@endforeach
	</div>
	@endif

	@if($entertainers->count() > 0 || $shows->count() > 0)
	<div class="bucket-section mb-5">
		<h2 class="font-weight-bold mb-3">Entertainment &amp; Shows</h2>
		@foreach($entertainers as $entertainer)
		@include('bucket-list.print._place', ['bucket_item' => $entertainer])
		@endforeach

		@foreach($shows as $show)
		@php
		$item = $bucket->shows()->where('id', $show->id)->first();
		$notes = $item->pivot->notes;
		@endphp
		@include('bucket-list.print._show')
		@endforeach
	</div>
	@endif

	@if($accommodations->count() > 0)
	<div class="bucket-section mb-5">
		<h2 class="font-weight-bold mb-3">Places to Stay</h2>
		@foreach($accommodations as $accommodation)
		@include('bucket-list.print._place', ['bucket_item' => $accommodation])
		@endforeach
	</div>
	@endif

	@if($coupons->count() > 0)
	<div class="bucket-section mb-5">
		<h2 class="font-weight-bold mb-3">Coupons</h2>
		<div class="row">
		@foreach($coupons as $coupon)
			<div class="col-md-6 mb-5">
				@include('bucket-list.print._coupon')
			</div>
		@endforeach
		</div>
	</div>
	@endif

	@if($articles->count() > 0)
	<div class="bucket-section mb-5">
		<h2 class="font-weight-bold mb-3">Trip Ideas/Visitor Info.</h2>
		@foreach($articles as $article)
		@include('bucket-list.print._article', ['bucket_item' => $article])
		@endforeach
	</div>
	@endif

</div>

@endsection