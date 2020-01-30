<div class="col-lg-4 col-md-6 mb-3 mb-md-4 px-md-0">
	<div class="card h-100 overlay">
		@if(null !== $advertiser->getFirstMedia('slider'))
		<div class="card-img-top">
			@include('partials._images', ['item' => $advertiser, 'random' => true])
		</div>
		@endif
		
		<div class="card-body">
			<a href="{{ $advertiser->path() }}#coupons" class="stretched-link text-reset text-decoration-none">
				<div class="advertiser">{{ $advertiser->name }}</div>
				<div class="card-offer">{{ $coupon->offer }}</div>
				<div class="card-suboffer">{{ $coupon->suboffer }}</div>
			</a>

			@if($advertiser->level_id === 3)
			<div class="premier-tab">
				TOP DEAL
			</div>
			@endif

		</div>
		<div class="card-icon">
			<bucket-button item-id="{{ $coupon->id }}" item-class="App\Coupon"></bucket-button>
		</div>

	</div> <!-- End Card-->

</div> <!-- End Column-->