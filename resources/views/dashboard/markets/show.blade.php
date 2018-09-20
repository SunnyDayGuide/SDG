@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
			<h1>{{ $market->name }}</h1>
			</div>
			<ul>
				@foreach ($market->categories as $category)
				<li>{{ $category->name }}</li>
				@endforeach
			</ul>
		</div> <!-- End Row -->

	</div>

@endsection
