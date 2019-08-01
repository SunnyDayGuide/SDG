@extends('layouts.print')
@section('content')
<nav class="container d-print-none">
	<div class="list-group list-group-horizontal">
		@foreach($markets->sortBy('code') as $navMarket)
		<a href="/categories/{{ $navMarket->slug }}" class="list-group-item list-group-item-action {{ (request()->segment(2) == $navMarket->slug) ? 'active' : '' }} text-center font-weight-bold">{{ $navMarket->code }}</a>
		@endforeach
		<a href="/categories/" class="list-group-item list-group-item-action {{ (request()->is('categories')) ? 'active' : '' }} text-center font-weight-bold">ALL</a>
	</div>
</nav>

<div class="container my-5 mx-auto">
	<h1>Advertisers per Subcategory -- All Markets</h1>
	<div class="row">
		@foreach($categories as $category)
		<div class="col-md-3 my-4">
			<h3 class="bg-primary text-white p-2">{{ $category->name }}</h3>
			<ul class="list-unstyled">
				@foreach ($category->children->sortBy('name') as $subcategory)
				<li class="subcategory text-primary mt-3"><h5>{{ $subcategory->name }} - {{ $subcategory->advertisers_count }}</h5></li>
				@endforeach
			</ul>
		</div>
		@endforeach
	</div>
</div>


@endsection