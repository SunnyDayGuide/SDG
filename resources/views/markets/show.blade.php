@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col">
				<div class="jumbotron">
				  <h1 class="display-4">Welcome to {{ $market->name }}, {{ $market->state->name }}!</h1>
				  <p class="lead">Here lies some market specific slide show or something. You are on the {{ $market->code }} home page</p>
				  <hr class="my-4">
				  <p>It might list the market's cities like this: {{ $market->cities }} if they exist</p>
				  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
				</div>
			</div>
		</div> <!-- End Row -->

		<div class="row">
			<div class="col">
				<h2>Featured Articles</h2>
				<div class="row">
					@include('articles._featured')
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<h2>Featured Events</h2>
			</div>
		</div>
	</div> <!-- End Container -->

@endsection
