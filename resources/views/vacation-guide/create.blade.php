@extends('layouts.app')

@section('styles')
<link href="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('jumbotron')
<div class="page-header w-100">
	<div class="container overlay-container position-relative">
		<div class="col-3 offset-9">
			<div class="image-overlay">
				<img src="{{ asset('images/'.$market->slug.'/guide-cover.jpg') }}" alt="{{ $market->brand->name }}">
			</div>
		</div>
	</div>
	<div class="title-container">
		<div class="title">
			<div class="container">
				<div class="col-md-7 pl-0">
					<h1>{{ $page->title }}</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="main-image">
		{{ $mainImage }}
	</div>
</div>
@endsection

@section('content')
<div class="container mt-3 mt-md-5 mb-5">
	<div class="content">
		<div class="fr-view">{!! $page->content !!}</div>
	</div>

	<h4 class="rounded bg-editorial text-white text-center my-4 p-3">Fill out this form to get a digital copy of {{ $market->brand->name }} and start planning your dream vacation to {{ $market->name }} today!</h4>

	<div class="row">
		<div class="col-md-8 offset-md-2">
			@include('visitor-leads._form', ['type' => 'guide-request', 'buttonText' => 'Get Your Guide!'])
			@include ('partials._messages')
		</div>
	</div>

</div>


@endsection

@section('scripts')
<script src="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
	$('#visit_date').datepicker({
		autoclose: true,
		todayBtn: "linked",
		orientation: "auto"
	});  
</script> 
@endsection