@extends('layouts.app')

@section('styles')
<link href="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="container mt-5 mb-5">
	<div class="content">
		<h1 class="display-2">Request More Information</h1>

		<div class="fr-view">
			<p>Keep up on {{ $market->name }} news by completing the form below. Featuring updates about local events, restaurants, businesses and special promotions, the {{ $market->brand->name }} e-newsletter is the best way to stay in-the-know on the latest and greatest in {{ $market->name }}.</p>

			<p>Our objective is to provide you with the best information regarding {{ $market->name }}, {{ $market->state->abbr }}. Your inquiry and personal information that you provide in this form will be forwarded to our advertisers, so they might fill your request for information and/or services about the area. Therefore, your personal information may be added to a mailing list to fulfill your request. By selecting the "Submit Your Request" button below, you agree to this use of your personal information and to receive mail or email from {{ $market->brand->name }} and/or its Advertisers.</p>
		</div>

	</div>
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h3 class="text-primary">Fill out this form to get more information about {{ $market->name }} and start planning your dream vacation today!</h3>

			@include('visitor-leads._form', ['type' => 'information-request', 'buttonText' => 'Submit your Request'])

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