<div class="panel-subcat">
	<div class="text-center mb-5">
		<div class="fr-view">
			{!! $page->subcategory_header !!}
		</div>
	</div>
	
	<div class="row">
		<div class="card-deck w-100 mx-md-0 slick4 sdg-slick">
			@foreach ($subcatImages as $subcatImage)
			<div class="col-md-3 px-md-0">
				<a href="{{ $market->path().'/'.$category->slug.'/'.$subcatImage->category->slug }}">
					<div class="card text-white overlay border-0">

						@if(null !== $subcatImage->getFirstMedia('slider'))
						@include('partials._images', ['collectionName' => 'slider', 'profile' => 'sm-card', 'item' => $subcatImage])
						@endif

						<div class="card-img-overlay d-flex flex-column justify-content-end px-0 pb-0">
							<p class="h4 font-weight-bold mb-0 bg-highlight p-2">{{ $subcatImage->category->name }}</p>
						</div>

					</div>
				</a>
			</div>
			@endforeach
		</div> <!-- End Card Group-->
	</div>
</div>

