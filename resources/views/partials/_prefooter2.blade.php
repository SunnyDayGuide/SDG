<div class="guide-banner" style="background: url({{ asset('images/main/footer-banner-bkgrnd.jpg') }})  no-repeat center center; background-size: cover;">
	<div class="container">
		<div class="row justify-content-around align-items-center buttons-container">
			<div class="col-md-6 d-flex align-items-center h-100">
				<div class="footer-guide p-2">
					<img src="{{ asset('images/'.$market->slug.'/guide-cover.jpg') }}" alt="{{ $market->brand->name }}" class="img-fluid ">
					<a class="btn btn-guide" href="{{ route('vacation-guide.create', $market->slug) }}">FREE Digital Vacation Guide</a>
				</div>
			</div>
			<div class="col-md-6 d-flex align-items-center h-100">
				<div class="p-2">
					<a class="btn" href="{{ route('request-information.create', $market->slug) }}">Sign-up for Special Deals & News</a>
				</div>
			</div>
		</div>
	</div>
</div>