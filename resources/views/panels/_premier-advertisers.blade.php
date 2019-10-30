	<!-- Premier Advertiser Section -->
	<section class="panel panel-advertisers mt-5">
		<div class="container">

			<div class="border-bottom border-white mb-3 w-100">
				<h2>{{ $market->name }} Highlights</h2>
			</div>

			<div class="row advertiser-cards">
				<div class="card-deck w-100 mx-md-0 {{ $slick == true ? 'slick3 sdg-slick' : '' }}">
					@foreach ($premierAdvertisers as $advertiser)
						@include('advertisers._card', ['item' => $advertiser, 'column' => 'col-md-4', 'profile' => 'card', 'excerpt' => $advertiser->present()->blurb_long])
					@endforeach
				</div> <!-- End Card Deck-->
			</div> <!-- End Row-->

		</div>
	</section> <!-- End Premier Advertiser Section -->