<div class="coupon-container p-3 mb-4">
	<div class="offer">{{ $coupon->offer }}</div>
	<div class="suboffer">{{ $coupon->suboffer }}</div>
	<div class="d-md-flex justify-content-between align-items-center">
		<div class="p-2 flex-fill mr-3 {{ $coupon->promo_code || $coupon->barcode ? 'text-md-left' : '' }} disclaimer">{{ $coupon->disclaimer }}</div>
		@if($coupon->promo_code || $coupon->barcode)
		<div class="p-2 flex-fill">
			@if($coupon->promo_code)
				<div class="font-weight-bold mb-3">PROMO CODE: <span class="promo-code">{{ $coupon->promo_code }}</span></div>
			@endif
			@if($coupon->barcode)
			<div>
				{!! $coupon->barcodeSVG !!}
				{{-- <div>{{ $coupon->barcode }}</div> --}}
			</div>
			@endif			
		</div>
		@endif

	</div>
	<div class="coupon-logo">{{ $coupon->logo->getFirstMedia('logo') }}</div>
	
	<div class="mt-4 d-flex justify-content-between align-items-end coupon-footer">
		<div class="text-uppercase print"><a href="{{ route('print.single', [$coupon->market, $coupon->advertisers->first()->slug, $coupon->id]) }}"><i class="fas fa-print fa-lg fa-fw mr-2" aria-hidden="true"></i>Print</a> or show this {{ $coupon->market->brand->name }} coupon on your phone</div>
		<a v-on:click="removeItem">
			<i class="far fa-trash-alt fa-lg" title="remove"></i>
		</a>
	</div>
</div>