@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
			<h1>{{ $market->name }} Home Page</h1>
			</div>
			<div class="list-group">
				@foreach ($market->categories as $category)
				<a href="{{ $category->slug }}" class="list-group-item list-group-item-action">{{ $category->name }}</a>
				@endforeach
			</div>
		</div> <!-- End Row -->
	</div>

@endsection
