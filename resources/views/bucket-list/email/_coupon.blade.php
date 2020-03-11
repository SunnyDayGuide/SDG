@php
$item = $bucket->coupons()->where('id', $coupon->id)->first();
$notes = $item->pivot->notes;
@endphp
<div class="bucket-item">
<div class="coupon-container">
<div class="offer">{{ $coupon->offer }}</div>
<div class="suboffer">{{ $coupon->suboffer }}</div>
<div class="disclaimer my-3">{{ $coupon->disclaimer }}</div>
@if($coupon->promo_code)
<div class="promo-code my-3">PROMO CODE: {{ $coupon->promo_code }}</div>
@endif
@if($coupon->barcode)
<div>
{!! $coupon->barcodeSVG !!}
</div>
@endif			
<div class="coupon-logo my-3">{{ $coupon->logo->getFirstMedia('logo') }}</div>
<div class="coupon-footer mt-3">Show this {{ $coupon->market->brand->name }} coupon.</div>
</div>
@if($notes)
<div class="my-3">
<strong>NOTES: </strong>{{ $notes }}
</div>
@endif
</div>