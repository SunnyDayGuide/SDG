@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
	{{ $mainImage }}
</div>
@endsection

@section('content')

<div class="container my-3 my-md-5">

	<div class="page-header mb-md-5">
		<div class="page-title">
			<h1 class="display-4">{{ $page->title }}</h1>
		</div>

		<div class="fr-view content">{!! $page->content !!}</div>

	</div>
	
	<div class="panel panel-light py-3 py-md-5 px-md-5">
		<div class="container">
			<div class="flex">
		<h2 class="text-center font-weight-bold text-primary mb-md-3">Start Saving Money on your {{ $market->name }} Vacation!</h2>

		@include('categories._search')  {{-- @include('coupons._search') --}}

		<div class="d-flex flex-wrap justify-content-between mt-3">
			<div class="d-flex flex-wrap" id="left-side">
				<div class="dropdown mr-3 mb-2">
					<button class="btn btn-primary dropdown-toggle" type="button" id="couponDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Jump to a Coupon Section
					</button>
					<div class="dropdown-menu" aria-labelledby="couponDropdownMenuButton">
						<a class="dropdown-item" href="#activities">Activities &amp; Attractions</a>
						<a class="dropdown-item" href="#dining">Restaurants &amp; Dining</a>
						<a class="dropdown-item" href="#shopping">Shopping</a>
						@if(($market->code == 'BR' || $market->code == 'SM'))
						<a class="dropdown-item" href="#entertainment">Entertainment</a>
						@endif
					</div>
				</div> <!-- End Dropdown -->
				<div>
					<a href="{{ url($market->slug.'/pdfs/coupons/'.$market->code.'_all.pdf') }}" class="btn btn-primary">Download All Coupons</a>
				</div>
			</div>

			<div id="right-side">
				<div class="d-flex align-items-center">
					<div class="bucket-instructions text-primary font-weight-bold mr-3 text-right">Add Coupon to your Bucket List <i class="fas fa-arrow-right"></i></div>
					<div class="bucket-btn"><span class="icon-bucket position-relative text-advertiser"><span class="bucket-items"><i class="fas fa-plus-circle text-white"></i></span></span></div>
				</div>
			</div>
		</div>
	</div>
		</div>
	</div>
	

	@include('coupons._category', ['category' => 'activities'])
	@include('banners._zone1')
	@include('coupons._category', ['category' => 'dining'])
	@include('banners._zone1')
	@include('coupons._category', ['category' => 'shopping'])
	@include('banners._zone1')
	@include('coupons._category', ['category' => 'entertainment'])

</div> <!-- End Container -->

@endsection
