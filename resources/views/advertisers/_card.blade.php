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
		<p class="card-text">{{ $excerpt }}</p>

		@if($item->coupons->count())
		<div class="coupon-icon">
			<span class="fa-stack fa-sm">
			  <i class="fas fa-certificate fa-stack-2x"></i>
			  <i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
			</span>
		</div>
		@endif
	</div>

	@if ($item->tags->count())
	<div class="card-footer">
		@foreach($item->tags as $tag)
		<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
		@endforeach
	</div>
	@endif

	</div> <!-- End Card-->
</div>