@extends('layouts.app')

@section('jumbotron')
<div class="slider w-100">
	{{ $mainImage }}
</div>
@endsection

@section('content')

<div class="container my-3 my-md-5">
	<div class="content">
		<div class="page-title">
			<h1 class="display-4">{{ $page->title }}</h1>
		</div>

		<div class="fr-view page-body">
			{!! $page->content !!}
		</div>
	</div>
</div>

@if(!$visitorInfos->isEmpty())
<section class="panel panel-light">
	<div class="container">
		<div class="text-center mb-3 mb-md-5">
			<h2 class="font-weight-bold">Local Information</h2>
		</div>

		<div class="row article-cards">
			<div class="col-md-8 offset-md-2">
				@foreach ($visitorInfos as $article)
				@include('articles._card-visitor-info')
				@endforeach
			</div> <!-- End Card Deck-->
		</div> <!-- End Row-->
	</div>
</section>
@endif

<div class="col-12 mb-md-4 mb-3 px-md-0">
	@include('banners._zone1')
</div>


@if(!$maps->isEmpty())
<section class="panel">
	<div class="container">
		<div class="text-center mb-3 mb-md-5">
			<h2 class="font-weight-bold">Area Maps</h2>
			<p>Let Sunny Day help you find your way! Our {{ $market->name }} area maps provide excellent detail of roadways and points of interest in the surrounding areas.</p>
		</div>

		<div class="row article-cards">
			<div class="col-md-8 offset-md-2">
				@foreach ($maps as $map)
				<div class="row no-gutters bucket-item mt-0">
					<div class="col-md-10 px-0 pt-0 pr-md-4">
						<h5 class="text-editorial card-title mb-1">{{ $map->name }}</h5>
						<p class="mb-1">{{ $map->description }}</p>
					</div>
					<div class="col-md-2 d-flex align-items-start justify-content-end">
						<a href="{{ url($map->file) }}" target="_blank" role="button" class="btn btn-sm btn-editorial">Get PDF</a>
					</div>
				</div>
				@endforeach
			</div> <!-- End Column-->
		</div> <!-- End Row-->
	</div>
</section>
@endif

@endsection

@section('scripts')
<script src="{{ asset('js/functions.js') }}"/></script>


@endsection
