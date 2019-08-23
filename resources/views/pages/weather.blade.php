@extends('layouts.app')
@section('title')
{{ $market->name }} {{ $page->title }}
@endsection

@section('content')
<div class="container mt-5 mb-5">
	<div class="content">
		<h1 class="display-4">{{ $market->name }} {{ $page->title }}</h1>

		<div id="forecast" class="my-4">{!! $forecast !!}</div>

		<div class="fr-view">{!! $page->content !!}</div>

	</div>
</div>


@endsection

@section('scripts')
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>
@endsection
