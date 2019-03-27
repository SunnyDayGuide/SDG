@extends('layouts.app')

@section('content')

<div class="search p-5">
	<h2 class="m-auto text-center">This is the search box</h2>
	<button class="btn btn-primary">Search</button>
</div>


<div class="container mt-5">

	<div>
		<div>
			<h1>{{ $market->name }}, {{ $market->state->name }} Coupons</h1>
		</div>
	</div> <!-- End Row -->

	<div>
		@foreach ($advertisers as $advertiser)
			@foreach($advertiser->coupons->where('category_id', 1) as $coupon)
			<div class="bg-advertiser my-3 p-4">
				@if(null !== $advertiser->getFirstMedia('slider'))
				<div class="card-img-top">
					<a href="{{ $advertiser->path() }}">
						@include('partials._images', ['item' => $advertiser])
					</a>
				</div>
				@endif
				<div><strong>{{ $advertiser->name }}</strong></div>
				<div>{{ $coupon->offer }}</div>
				<div>{{ $coupon->suboffer }}</div>
				<div>{{ $coupon->category->name }}</div>
			</div>
			@endforeach			
		@endforeach
	</div>

	<section>
		<div>
			<h2>Activities</h2>
				@foreach ($activities as $coupon)
					@foreach($coupon->advertisers as $advertiser)
					<div class="bg-advertiser my-3 p-4">
						@if(null !== $advertiser->getFirstMedia('slider'))
						<div class="card-img-top">
							<a href="{{ $advertiser->path() }}">
								@include('partials._images', ['item' => $advertiser])
							</a>
						</div>
						@endif
						<div><strong>{{ $advertiser->name }}</strong></div>
						<div>{{ $advertiser->market->name }}</div>
						<div>{{ $coupon->offer }}</div>
						<div>{{ $coupon->suboffer }}</div>
						<div>{{ $coupon->market->name }}</div>
					</div>	
					@endforeach			
				@endforeach
		</div> <!-- End Row-->
	</section>

	<section>
		<div>
			<h2>Dining</h2>
				@foreach ($dining as $coupon)
					@foreach($coupon->advertisers as $advertiser)
					<div class="bg-advertiser my-3 p-4">
						@if(null !== $advertiser->getFirstMedia('slider'))
						<div class="card-img-top">
							<a href="{{ $advertiser->path() }}">
								@include('partials._images', ['item' => $advertiser])
							</a>
						</div>
						@endif
						<div><strong>{{ $advertiser->name }}</strong></div>
						<div>Advertiser Market: {{ $advertiser->market->name }}</div>
						<div>{{ $coupon->offer }}</div>
						<div>{{ $coupon->suboffer }}</div>
						<div>{{ $coupon->market->name }}</div>
					</div>	
					@endforeach			
				@endforeach
		</div> <!-- End Row-->
	</section>

	<section>
		<div>
			<h2>Shopping</h2>
				@foreach ($shopping as $coupon)
					@foreach($coupon->advertisers as $advertiser)
					<div class="bg-advertiser my-3 p-4">
						@if(null !== $advertiser->getFirstMedia('slider'))
						<div class="card-img-top">
							<a href="{{ $advertiser->path() }}">
								@include('partials._images', ['item' => $advertiser])
							</a>
						</div>
						@endif
						<div><strong>{{ $advertiser->name }}</strong></div>
						<div>Advertiser Market: {{ $advertiser->market->name }}</div>
						<div>{{ $coupon->offer }}</div>
						<div>{{ $coupon->suboffer }}</div>
						<div>{{ $coupon->market->name }}</div>
					</div>	
					@endforeach			
				@endforeach
		</div> <!-- End Row-->
	</section>

</div> <!-- End Content Container -->

@endsection
