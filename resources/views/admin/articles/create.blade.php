@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2">{{ $market->name }} - Create Article</h1>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.articles.store', $market->slug) }}" enctype="multipart/form-data">
@csrf
@include('admin.articles._form')

</form>
@include ('partials._messages')

@endsection

@section('scripts')
@include ('admin.partials._tagscript')
@endsection