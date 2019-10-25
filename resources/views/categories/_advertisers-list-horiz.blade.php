<div id="advertisers" class="mt-5">
	<div class="row mx-3">
		<div class="col-md-8 offset-md-2">
			@foreach ($advertisers as $advertiser)
			<div class="card card-advertiser overlay mb-4">
				<div class="row no-gutters">
					<div class="col-md-5">
						@if(null !== $advertiser->getFirstMedia('slider'))
						<div class="card-img">
							<a href="{{ $advertiser->path() }}">
								@include('partials._images', ['item' => $advertiser])
							</a>
						</div>
						@endif
					</div>
					<div class="col-md-7">
						<div class="card-body">
							<a href="{{ $advertiser->path() }}" class="stretched-link text-reset text-decoration-none">
								<h5 class="card-title">{{ $advertiser->name }}</h5>
							</a>
							<div class="card-text">{!! $advertiser->present()->blurb !!}</div>

							@if($advertiser->coupons->count())
							<div class="coupon-icon">
								<span class="fa-stack fa-sm">
									<i class="fas fa-certificate fa-stack-2x"></i>
									<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
								</span>
							</div>
							@endif

						</div>


						@if ($advertiser->tags->count())
							<div class="card-footer">
							@include('tags._links', ['item' => $advertiser, 'color' => 'advertiser'])
							</div>
						@endif

					</div>
				</div>
			</div>
			@endforeach

			<div class="mb-md-4 mb-3 px-md-0">
				@include('banners._zone1')
			</div>
			
		</div>
	</div>
</div>
