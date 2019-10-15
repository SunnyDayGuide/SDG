<div class="media">
	@if(null !== $advertiser->getFirstMedia('slider'))
	<a href="{{ $advertiser->path() }}">
		@include('partials._images', ['item' => $advertiser])
	</a>
	@endif
	<div class="media-body">
		<a href="{{ $advertiser->path() }}" class="stretched-link text-reset text-decoration-none">
			<h5 class="card-title">{{ $advertiser->name }}</h5>
		</a>
		<div class="card-text">{!! $advertiser->blurb !!}</div>

		@if($advertiser->coupons->count())
		<div class="coupon-icon">
			<span class="fa-stack fa-sm">
				<i class="fas fa-certificate fa-stack-2x"></i>
				<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
			</span>
		</div>
		@endif

		@if ($advertiser->tags->count())
		<div class="card-footer">
			@include('tags._links', ['item' => $advertiser, 'color' => 'advertiser'])
		</div>
		@endif
	</div>
</div>