<div id="premierAdvertisers" class="mt-5">
	@foreach ($premierAdvertisers as $premierAdvertiser)
	<div class="card card-advertiser card-featured overlay mb-4">
		<div class="row no-gutters">
			<div class="col-md-5">
				@if(null !== $premierAdvertiser->getFirstMedia('slider'))
				<div class="card-img">
					<a href="{{ $premierAdvertiser->path() }}">
						@include('partials._images', ['item' => $premierAdvertiser])
					</a>
				</div>
				@endif
			</div>
			<div class="col-md-7">
				<h5 class="card-header">Featured Listing</h5>
				<div class="card-body">
					<a href="{{ $premierAdvertiser->path() }}" class="stretched-link text-reset text-decoration-none">
						<h5 class="card-title">{{ $premierAdvertiser->name }}</h5>
					</a>
					<p class="card-text">{!! $premierAdvertiser->blurbLong !!}</p>

					@if($premierAdvertiser->coupons->count())
					<div class="coupon-icon">
						<span class="fa-stack fa-sm">
							<i class="fas fa-certificate fa-stack-2x"></i>
							<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					@endif
				</div>

				@if ($premierAdvertiser->tags->count())
				<div class="card-footer">
					@include('tags._links', ['item' => $premierAdvertiser, 'color' => 'advertiser'])
				</div>
				@endif

			</div>
		</div>
	</div>
	@endforeach
</div>
