@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Welcome to the {{ $market->name }} Dashboard</h1>
@endsection

@section('content')

	<p><strong>Market Name:</strong> {{ $market->name }}</p>
	<p><strong>Market Code:</strong> {{ $market->code }}</p>
	<p><strong>Slug:</strong> {{ $market->slug }}/</p>
	<p><strong>Alternate Name:</strong> {{ $market->name_alt ?: 'None' }}</p>
	<p><strong>State:</strong> {{ $market->state->name }}</p>
	<p><strong>Associated Cities:</strong> {{ $market->cities ?: 'None' }}</p>
	<p><strong>Sunny Day Brand:</strong> {{ $market->brand->name }}</p>

	<a href="{{ route('admin.markets.edit', $market->id) }}" class="btn btn-primary btn-lg">Edit Market</a>
	<p>This will only show to SuperAdmins</p>

@endsection
