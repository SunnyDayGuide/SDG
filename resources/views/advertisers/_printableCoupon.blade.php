<div class="coupon-container p-3 mb-4">
	<div class="offer">{{ $coupon->offer }}</div>
	<div class="suboffer">{{ $coupon->suboffer }}</div>
	<div>
		<div class="p-2 disclaimer">{{ $coupon->disclaimer }}</div>
		@if($coupon->promo_code || $coupon->barcode)
		<div class="p-2">
			@if($coupon->promo_code)
				<div class="font-weight-bold mb-3">PROMO CODE: <span class="promo-code">{{ $coupon->promo_code }}</span></div>
			@endif
			@if($coupon->barcode)
			<div>
				{!! $coupon->barcodeSVG !!}
				<div>{{ $coupon->barcode }}</div>
			</div>
			@endif			
		</div>
		@endif

	</div>
	<div class="logo">{{ $coupon->logo->getFirstMedia('logo') }}</div>
	
	<div class="mt-4 coupon-footer">
		<div class="text-uppercase">Coupon printed from {{ $market->brand->name }} online.</div>
	</div>
</div>