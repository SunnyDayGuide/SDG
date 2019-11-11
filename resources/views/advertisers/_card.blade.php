<div class="{{ $column }} mb-md-4 mb-3 px-md-0">
	<div class="card card-advertiser h-100 overlay">
		@if(null !== $item->getFirstMedia('slider'))
		<div class="card-img-top">
			@include('partials._images', ['item' => $item, 'profile' => $profile])
		</div>
		@endif

		<div class="card-body">
			<a href="{{ $item->path() }}" class="stretched-link text-reset text-decoration-none">
				<h5 class="card-title">{{ $item->name }}</h5>
			</a>
			<p class="card-text">{!! $excerpt !!}</p>
			
			@if(get_class($item) == 'App\Advertiser')
			@if($item->coupons->count())
			<div class="coupon-icon">
				<span class="fa-stack fa-sm">
					<i class="fas fa-certificate fa-stack-2x"></i>
					<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
				</span>
			</div>
			@endif
			@endif

		</div>
		
		@if(get_class($item) == 'App\Advertiser')
		@if ($item->tags->count())
		<div class="card-footer">
			@include('tags._links', ['item' => $item, 'color' => 'advertiser'])
		</div>
		@endif
		@endif

	</div> <!-- End Card-->
</div>