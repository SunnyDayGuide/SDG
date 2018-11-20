@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2">{{ $market->name }} - Edit Articles</h1>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.articles.update', [$market->slug, $article->id]) }}" enctype="multipart/form-data">
	@method('PATCH')
	@csrf
	@include('admin.articles._form', ['buttonText' => 'Update Article'])
</form>

@include ('partials._messages')

@endsection

@section('scripts')
@include ('admin.partials._tagscript')

@endsection