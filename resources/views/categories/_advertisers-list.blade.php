<div id="advertisers" class="advertisers mt-5">
	<div class="row mx-3">
		<div class="col-md-8 offset-md-2">
			<div class="row advertiser-cards">
				<div class="card-deck w-100 mx-md-0">
					@foreach ($advertisers as $advertiser)
					@include('advertisers._card', ['item' => $advertiser, 'column' => 'col-md-4', 'profile' => 'card', 'excerpt' => $advertiser->present()->blurb])

					@if($loop->iteration % 12 == 0)
					<div class="mb-md-4 mb-3 px-md-0">
						@include('banners._zone1')
					</div>
					@endif

					@endforeach

					@unless($advertisers->count() % 3 == 0)
					<div class="col mb-md-4 mb-3 px-md-0">
						<div class="card mt-0">
							@include('banners._zone1')
						</div>
					</div>
					@endunless

					@if($advertisers->count() < 12)
					<div class="mb-md-4 mb-3 px-md-0">
						@include('banners._zone1')
					</div>
					@endif

				</div> <!-- End Card Deck-->
			</div> <!-- End Cards Row-->
		</div>
	</div>
</div>