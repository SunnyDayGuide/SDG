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

	<section class="ads">
		<div class="row justify-content-center">
			<div class="col-8">
				<img src="http://placehold.it/706x213" alt="advertisement" class="img-fluid">
			</div>
		</div>
	</section>

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