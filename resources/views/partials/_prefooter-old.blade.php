<div class="guide-banner" style="background: url({{ asset('images/main/footer-banner-bkgrnd.jpg') }})  no-repeat center center; background-size: cover;">
	<div class="container">
		<div class="row justify-content-around align-items-center buttons-container py-5">
			<div class="col-md-6">
				<div class="row d-flex align-items-center position-relative footer-guide">
					<div class="col-4">
						{{ $market->getFirstMedia('cover') }}
					</div>
					<div class="col-8">
						<a class="btn" href="{{ route('vacation-guide.create', $market->slug) }}">FREE Digital Vacation Guide</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<a class="btn" href="{{ route('request-information.create', $market->slug) }}">Sign-up for Promotions & News</a>
			</div>
		</div>
	</div>
</div>