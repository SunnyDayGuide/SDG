@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2">{{ $market->name }} - Edit Articles</h1>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.articles.update', [$market->slug, $article->id]) }}" enctype="multipart/form-data">
{{ csrf_field() }}
@include('admin.articles._form')

@include ('partials._messages')
</form>

@endsection