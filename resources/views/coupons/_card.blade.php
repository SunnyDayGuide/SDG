<div class="col-lg-4 col-md-6 mb-3 px-md-0">
	<a href="{{ $advertiser->path() }}#coupons" class="overlay text-reset text-decoration-none">
		<div class="card h-100">
			@if(null !== $advertiser->getFirstMedia('slider'))
			<div class="card-img-top">
				@include('partials._images', ['item' => $advertiser, 'random' => true])
			</div>
			@endif
			
			<div class="card-body">
				<div class="advertiser">{{ $advertiser->name }}</div>
				<div class="card-offer">{{ $coupon->offer }}</div>
				<div class="card-suboffer">{{ $coupon->suboffer }}</div>

				@if($advertiser->level_id === 3)
				<div class="premier-tab">
					TOP DEAL
				</div>
				@endif

			</div>

		</div> <!-- End Card-->
	</a>

</div> <!-- End Column-->