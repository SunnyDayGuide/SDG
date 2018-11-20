@extends('layouts.app')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ $tag->name }}</h1>
			</div>	
		</div> <!-- End Row -->

		<hr>

		<div class="row mt-5 bg-light">
			<div class="col-md-12">
				<h2>Related Articles</h2>
				<div class="row">
					@include('articles._featured')
				</div>
			</div>
		</div> <!-- End Row -->

		<div class="row mt-5 bg-primary">
			<div class="col-md-12">
				<h2>Related Advertisers</h2>
				<div class="row">
					<p>a list of advertisers here</p>
				</div>
			</div>
		</div> <!-- End Row -->

		<div class="row mt-5 bg-danger">
			<div class="col-md-12">
				<h2>Related Events</h2>
				<div class="row">
					<p>a list of event here</p>
				</div>
			</div>
		</div> <!-- End Row -->

	</div>

@endsection
