<div class="col-lg-4 col-md-6 mb-md-4 mb-3 px-md-0">
	<a href="{{ $advertiser->path() }}" class="overlay text-reset text-decoration-none">
		<div class="card card-advertiser h-100">
			@if(null !== $advertiser->getFirstMedia('slider'))
			<div class="card-img-top">
				@include('partials._images', ['item' => $advertiser])
			</div>
			@endif

			<div class="card-body">
				<h5 class="card-title">{{ $advertiser->name }}</h5>
				<p class="card-text">{{ $advertiser->blurb }}</p>
			</div>

			@if ($advertiser->tags->count())
			<div class="card-footer">
				@foreach($advertiser->tags as $tag)
				<a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
				@endforeach
			</div>
			@endif

		</div> <!-- End Card-->
	</a>

</div> <!-- End Column-->