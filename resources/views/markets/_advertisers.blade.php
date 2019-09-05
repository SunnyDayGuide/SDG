<section id="advSpotlights" class="panel panel-advertisers mt-5">
	<div class="container">
		<div class="border-bottom border-white mb-3 w-100">
			<h2>Advertiser Spotlights</h2>
		</div>

		<div class="row">
			<div class="card-deck w-100 mx-md-0 basic-slick">
				@foreach ($premierAdvertisers as $advertiser)
				@include('panels._advertisers')
				@endforeach
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->

	</div> 
</section> 