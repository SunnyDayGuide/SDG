@if(!${ $category }->isEmpty())
<section class="coupon-section my-5" id="{{ $category }}">
	<h2>
		{{ $market->name }} {{ ucwords($category) }} Coupons
		<small class="text-muted"><a href="{{ url($market->slug.'/pdfs/coupons/'.$category.'.pdf') }}" class="text-reset pdf-download">Download PDF</a></small>
	</h2>
	<!-- Featured & Premier Advertisers -->
	<div class="row coupon-cards">
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
	<div class="row justify-content-center coupon-listings">
		<div class="col-md-8">
			@foreach (${ $category } as $coupon)
				@foreach($coupon->advertisers->where('level_id', 1) as $advertiser)
					@include('coupons._listing')
				@endforeach	
			@endforeach
		</div>
	</div>

</section>
@endif