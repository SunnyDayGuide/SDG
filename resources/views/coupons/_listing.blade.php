<div class="coupon-list-item">
	<a href="{{ $advertiser->path() }}" class="text-reset text-decoration-none">
		<div class="card-advertiser">{{ $advertiser->name }}</div>
		<div class="card-offer">{{ $coupon->offer }}</div>
		<div class="card-suboffer">{{ $coupon->suboffer }}</div>
	</a>
</div>
