	<!-- Related Articles Section -->
	<section class="panel panel-articles mt-5">
		<div class="container">

			<div class="border-bottom border-white mb-3 w-100">
				<h2>You May Also Be Interested In</h2>
			</div>

			<div class="row">
				<div class="card-deck w-100 mx-md-0">
					@foreach ($articles as $article)
						@include('articles._card')
					@endforeach
				</div> <!-- End Card Deck-->
			</div> <!-- End Row-->			

		</div>
	</section> <!-- End Related Articles Section -->