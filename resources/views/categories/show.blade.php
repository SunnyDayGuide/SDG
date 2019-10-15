@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
	{{-- If there is more than one image, render a slider --}}
	@if($slides->count() > 1)
	<div id="slider" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach($slides as $slide)
			<li data-target="#slider" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
			@endforeach
		</ol>
		<div class="carousel-inner" role="listbox">
			@foreach($slides as $slide)
			<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
				{{ $slide('full') }}
			</div>
			@endforeach
		</div>
	</div>

	{{-- Otherwise just spit out a single image --}}
	@else
	{{ $image }}

	@endif

</div>
@endsection

@section('content')

<div class="container my-3 my-md-5">
	<div class="content">
		<div class="page-title">
			<h1 class="display-4">{{ $page->title }}</h1>
		</div>

		<div class="fr-view page-body">
			{!! $page->body !!}
		</div>

		@if(($market->code == 'BR') && ($category->id == 4))
		<a href="#show-schedule" class="btn btn-advertiser btn-lg text-white" role="button" aria-pressed="true">Jump to the Show Schedule</a>
		@endif
	</div>
</div>

<!--Subcategories carousel Section -->
<section id="subcat-panel" class="mt-5">
	<div class="container">
		@include('categories._subcat-panel')
	</div>
</section>
<!--End Subcategories carousel Section -->

<!-- Advertiser Listings Section -->
<section class="panel panel-light mt-5">
	<div class="container">
		<div class="text-center">
			<h2 class="font-weight-bold">Explore {{ $market->name }} {{ $category->name }}</h2>
		</div>

		@include('categories._search')

		<div class="d-md-flex justify-content-end mb-3">
			{{-- <h2>Featured {{ $category->name }}</h2> --}}
			<div class="coupon-legend d-flex align-items-center">
				<span class="fa-stack fa-sm">
					<i class="fas fa-certificate fa-stack-2x"></i>
					<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
				</span><span class="py-1">= Has Coupon</span>
			</div>
		</div>


		<!--Premier Advertisers Section -->
		@if(!$premierAdvertisers->isEmpty())
		@include('categories._advertisers-list-premier')
		@endif
		<!--End Premier Advertisers Section -->

		<!--Regular Advertisers Section -->
		@include('categories._advertisers-list')
		<!--End Regular Advertisers Section -->

	</div> <!-- End Container -->
</section>
<!-- End Advertiser Listings Section -->

@if(($market->code == 'BR') && ($category->id == 4))
<!-- Branson Show Schedule Section -->
<section id="show-schedule" class="panel">
	<div class="container">
		<div class="">
			<h2 class="text-center font-weight-bold">See the Latest Branson Show Schedules</h2>
			<p>Bacon ipsum dolor amet kielbasa pancetta beef ribs bacon doner leberkas, tenderloin short loin corned beef venison ball tip pork loin flank. Beef ribs kevin burgdoggen, pork belly beef boudin biltong shank pastrami landjaeger. Tenderloin salami jerky porchetta, tongue swine ball tip cupim ground round. Corned beef jerky shankle, flank ball tip burgdoggen venison ham hock kevin doner. Ham hock chuck ball tip filet mignon, salami flank shoulder.</p>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="list-group list-group-flush show-list mt-5">
					@foreach($shows as $show)  
					<a href="{{ $show->path() }}" class="list-group-item list-group-item-action show-item {{ $show->advertiser ? 'bg-advertisers-lt' : '' }}">
						<span class="{{ $show->advertiser ? 'font-weight-bold' : '' }}">{{ $show->name }}</span>
						<span class="small">@if($show->theater) - {{ $show->theater->name }}, @endif
							{{ $show->local_phone }}</span>
						@if($show->advertiser && $show->advertiser()->has('coupons'))
						<div class="coupon-icon">
							<span class="fa-stack fa-xs">
								<i class="fas fa-certificate fa-stack-2x"></i>
								<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
							</span>
						</div>
						@endif
					</a>
					@if($loop->iteration % 20 == 0)
					<div class="col-md-12 my-md-4 my-3 px-md-0">
						<div class="banner-ad">
							I AM A BANNER AD
						</div>
					</div>
					@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Branson Show Schedule Section -->
@endif

@include('panels._related-articles', ['articles' => $relatedArticles])

@endsection

@section('scripts')
<script src="{{ asset('js/functions.js') }}"/></script>
@endsection
