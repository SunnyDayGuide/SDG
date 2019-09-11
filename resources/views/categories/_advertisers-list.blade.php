<div id="advertisers" class="advertisers mt-5">
	<div class="row mx-3">
		<div class="col-md-8 offset-md-2">
			{{-- <div class="d-md-flex justify-content-between border-bottom border-advertisers mb-3">
				<h2>{{ $category->name }} Listings</h2>
				<div class="coupon-legend d-flex align-items-center">
					<span class="fa-stack fa-sm">
						<i class="fas fa-certificate fa-stack-2x"></i>
						<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
					</span><span class="py-1">= Listing has a Coupon</span>
				</div>
			</div> --}}

			<div class="row advertiser-cards">
				<div class="card-deck w-100 mx-md-0">
					@foreach ($advertisers as $advertiser)
					@include('advertisers._card', ['item' => $advertiser, 'column' => 'col-md-4', 'profile' => 'card', 'excerpt' => $advertiser->blurb])

					@if($loop->iteration % 12 == 0)
					<div class="col-md-12 mb-md-4 mb-3 px-md-0">
						<div class="banner-ad">
							I AM A BANNER AD
						</div>
					</div>
					@endif

					@endforeach

					@unless($advertisers->count() % 3 == 0)
					<div class="col mb-md-4 mb-3 px-md-0">
						<div class="banner-ad mt-0">
							I AM A FILLER BANNER/GOOGLE AD
						</div>
					</div>
					@endunless

					@if($advertisers->count() < 6)
					<div class="col-md-12 mb-md-4 mb-3 px-md-0">
						<div class="banner-ad">
							I AM A BANNER AD
						</div>
					</div>
					@endif

				</div> <!-- End Card Deck-->
			</div> <!-- End Cards Row-->
		</div>
	</div>
</div>