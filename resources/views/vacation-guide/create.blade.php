@extends('layouts.app')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="container pt-3 pt-md-5">
    <article class="row">
        <div class="col">
            <h1 class="display-4 mb-3">{{ $page->title }}</h1>
            <div class="image-wrapper float-right col-6 col-md-4 ml-2 ml-md-4 pr-0 text-right">
{{--                 <img src="{{ asset('storage/images/'.$market->slug.'/guide-cover.jpg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
 --}}                {{ $cover('full') }}
            </div>
            <div>
                <div class="fr-view">{!! $page->content !!}</div>
            </div>
        </div>
    </article>
</div>
<div class="container mt-3 mt-md-5 mb-5">
	<h3 class="rounded bg-editorial text-white text-center my-4 p-3">Fill out the form below to get a digital copy of {{ $market->brand->name }} and start planning your dream vacation to {{ $market->name }} today!</h3>

	<div class="row">
		<div class="col-md-8 offset-md-2">
			@include('visitor-leads._form', ['type' => 'guide-request', 'buttonText' => 'Get Your Guide!'])
			@include ('partials._messages')
		</div>
	</div>

</div>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$('#visit_date').datepicker({
		autoclose: true,
		todayBtn: "linked",
		orientation: "auto"
	});  
</script> 
@endsection