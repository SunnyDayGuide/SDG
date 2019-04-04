@extends('layouts.print')

@section('content')
<div class="print-container">
	<div class="buttons d-print-none">
		<a href="#Print" onclick="window.print(); return false;" class="btn btn-primary">Click to Print</a>
		<a href="#Back" class="btn btn-primary" onClick="history.go(-1);return true;">Go Back</a>
	</div>
	<div class="row">
		@foreach($coupons as $coupon)
		<div class="col-md-6">
			@include('advertisers._printableCoupon')
		</div>
		@endforeach
	</div>
</div>

@endsection