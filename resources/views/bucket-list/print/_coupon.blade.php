@php
$item = $bucket->coupons()->where('id', $coupon->id)->first();
$notes = $item->pivot->notes;
@endphp
<div class="coupon-container p-3 my-0">
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
			</div>
			@endif			
		</div>
		@endif

	</div>
	<div class="coupon-logo">{{ $coupon->logo->getFirstMedia('logo') }}</div>
	
	<div class="mt-4 coupon-footer">
		<div class="text-uppercase print">Show this {{ $coupon->market->brand->name }} coupon on your phone</div>
	</div>
</div>

@if($notes)
<div class="bucket-notes px-4 py-3">
<strong>NOTES: </strong>{{ $notes }}
</div>
@endif