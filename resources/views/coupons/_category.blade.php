@if(!${ $category }->isEmpty())
<section class="coupon-section" id="{{ $category }}">
	<h2>{{ ucwords($category) }}</h2>
	<!-- Featured & Premier Advertisers -->
	<div class="row">
		<div class="card-deck mx-md-0">	
			@foreach (${ $category } as $coupon)
			@foreach($coupon->advertisers->where('level_id', '!=' , 1) as $advertiser)
			@include('coupons._card')
			@endforeach
			@endforeach
		</div> <!-- End Card Deck-->
	</div> <!-- End Row-->

	@include('banners._zone1')

	<!-- Standard Advertisers -->
	<div class="row justify-content-center">
		<div class="col-8">
			@foreach (${ $category } as $coupon)
			@foreach($coupon->advertisers()->standard()->get() as $advertiser)
			@include('coupons._listing')
			@endforeach	
			@endforeach
		</div>
	</div>

</section>
@endif