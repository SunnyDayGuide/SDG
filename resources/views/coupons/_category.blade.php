@if(!${ $category }->isEmpty())
<section class="panel coupon-section" id="{{ $category }}">
	<h2 class="text-highlight mb-3">
		{{ $market->name }} {{ ucwords($category) }} Coupons
		<small class="text-muted"><a href="{{ url($market->slug.'/pdfs/coupons/'.$market->code.'_'.$category.'.pdf') }}" class="text-reset pdf-download">Download PDF</a></small>
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