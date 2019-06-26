<footer>
	<div class="footer">
		<div class="container">
			<div class="row justify-content-between">

				<div class="col-6 col-md-2 ml-0 mb-4 mb-md-0">
					<div class="footer-guide overlay">
						<a href="{{ route('vacation-guide.create', $market->slug) }}">
							<img src="{{ asset('images/'.$market->slug.'/guide-cover.jpg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
							<div>
								View a Free Guide
							</div>
						</a>
					</div>
				</div>

				<div class="col-6 col-md-3 mb-4 mb-md-0">
					<h4 class="pb-2">{{ $market->name }}, {{ $market->state->iso_3166_2 }}</h4>
					<ul class="list-unstyled footer-nav">
						@foreach($market->categories as $category)
						<li>
							<a href="{{ $market->path().'/'.$category->slug }}">{{ $category->name }}</a>
						</li>
						@endforeach
						@if($market->code == 'BR')
						<li><a href="#">Show Schedule</a></li>
						@endif
					</ul>
					<hr>
					<ul class="list-unstyled footer-nav">
						<li><a href="{{ route('events', $market) }}">Events</a></li>
						<li><a href="{{ route('coupons', $market) }}">Coupons</a></li>
					</ul>

				</div>

				<div class="col-md-4 mb-4 mb-md-0">
					<h4 class="pb-2">Other Vacation Destinations</h4>
					<div class="row">
						<div class="col-6">
							<ul class="list-unstyled footer-nav">
								<li>
									<a href="{{ route('market.home', 'branson') }}">Branson, MO</a>
								</li>
								<li>
									<a href="{{ route('market.home', 'delaware-beaches') }}">Delaware Coast, DE</a>
								</li>
								<li>
									<a href="{{ route('market.home', 'hatteras-ocracoke') }}">Hatteras-Ocracoke, NC</a>
								</li>
								<li>
									<a href="{{ route('market.home', 'myrtle-beach') }}">Myrtle Beach, SC</a>
								</li>
								<li>
									<a href="{{ route('market.home', 'ocean-city') }}">Ocean City, MD</a>
								</li>
								<li>
									<a href="{{ route('market.home', 'outer-banks') }}">Outer Banks, NC</a>
								</li>
							</ul>
						</div>
						<div class="col-6">
							<ul class="list-unstyled footer-nav">
								<li>
									<a href="{{ route('market.home', 'sanibel-captiva') }}">Sanibel-Captiva & Fort Myers Beach, FL</a>
								</li>
								<li>
									<a href="{{ route('market.home', 'sarasota-bradenton') }}">Sarasota-Bradenton, FL</a>
								</li>
								<li>
									<a href="{{ route('market.home', 'smoky-mountains') }}">Smoky Mountains, TN</a>
								</li>
								<li>
									<a href=".{{ route('market.home', 'virginia-beach') }}">Virginia Beach, VA</a>
								</li>
								<li>
									<a href="{{ route('market.home', 'williamsburg') }}">Williamsburg, VA</a>
								</li>
							</ul>
						</div>
					</div>

				</div>

				<div class="col-md-2 mr-0 mb-4 mb-md-0">
					<h4 class="pb-2">Connect With Us</h4>
					<div class="social pb-4 pt-2">
						<a href="{{ $market->brand->facebook }}" target="_blank" aria-label="View {{ $market->brand->name }}'s Facebook page"><i class="fab fa-facebook fa-lg" aria-hidden="true"></i></a>	
						<a href="{{ $market->brand->instagram }}" target="_blank" aria-label="View {{ $market->brand->name }}'s Instagram Feed"><i class="fab fa-instagram fa-lg" aria-hidden="true"></i></a>
						<a href="{{ $market->brand->twitter }}" target="_blank" aria-label="View {{ $market->brand->name }}'s Twitter Feed"><i class="fab fa-twitter fa-lg" aria-hidden="true"></i></a>
						<a href="https://youtube.com/sunnydayguide" target="_blank" aria-label="View {{ $market->brand->name }}'s YouTube Channel"><i class="fab fa-youtube fa-lg" aria-hidden="true"></i></a>				
					</div>
					<ul class="list-unstyled footer-nav">
						<li><a href="#">Contact Us</a></li>
						<li><a href="{{ route('request-information.create', $market->slug) }}">Request Information</a></li>
						<li><a href="https://sunnydaysolutions.com" target="_blank">Advertise</a></li>
					</ul>
				</div>

			</div>
		</div>
	</div>

	<div class="w-100 bg-editorial p-3">
		<div class="container">
			<div class="d-md-flex">
				<div class="flex-md-grow-1 copyright">
					Copyright &copy; {{ now()->year }} Sunny Day Guide - All rights reserved.
				</div>
				<div class="text-right text-primary">
					<a href="#"><i class="fas fa-caret-right mr-2"></i>Privacy Policy</a>
				</div>
			</div>
		</div>
	</div>
</footer>