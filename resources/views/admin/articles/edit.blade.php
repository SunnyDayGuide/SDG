@extends('layouts.admin')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>Edit the Article</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<form method="POST" action="{{ route('admin.articles.update', [$market->slug, $article->id]) }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			@include('admin.articles._form')
			</form>
		</div>

	</div> <!-- end of row -->
</div>

@endsection