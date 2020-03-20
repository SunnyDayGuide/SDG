<footer>
	<div class="footer">
		<div class="container">
			<div class="row justify-content-between">

				<div class="col-8 offset-2 col-md-3 offset-md-0 order-5 order-md-1 mx-auto mx-md-0 text-center text-md-left">
					<a href="{{ route('home') }}">
						<img src="{{ asset('images/main/SDG-footer-logo.svg') }}" alt="Sunny Day Guide logo" class="w-auto">
					</a>
					<address class="mt-4 pl-md-2 text-white">
						800 Seahawk Circle, Suite 106<br>
						Virginia Beach, Virginia 23452<br>
						<strong>1-800-786-6932</strong>
					</address>
				</div>

				<div class="col-md-2 order-1 order-md-2 mb-4 mb-md-0 text-center text-md-left">
					<h4 class="pb-2">{{ $market->name }}, {{ $market->state->iso_3166_2 }}</h4>
					<ul class="list-unstyled footer-nav category-nav">
						@foreach($market->navCategories as $category)
						<li>
							<a href="{{ $market->path().'/'.$category->slug }}">{{ $category->name }}</a>
						</li>
						@endforeach
						<li><a href="{{ $market->path() }}/accommodations">Places to Stay</a></li>
					</ul>
					<hr>
					<ul class="list-unstyled footer-nav category-nav">
						<li><a href="{{ route('events', $market) }}">Events</a></li>
						<li><a href="{{ route('coupons', $market) }}">Coupons</a></li>
					</ul>

				</div>

				<div class="col-md-4 order-3 mb-4 mb-md-0">
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

				<div class="col-md-2 order-4 mr-0 mb-4 mb-md-0 text-center text-md-left">
					<h4 class="pb-2">Connect With Us</h4>
					<div class="social pb-4 pt-2">
						<a href="{{ $market->brand->facebook }}" target="_blank" aria-label="View {{ $market->brand->name }}'s Facebook page"><i class="fab fa-facebook fa-lg" aria-hidden="true"></i></a>	
						<a href="{{ $market->brand->instagram }}" target="_blank" aria-label="View {{ $market->brand->name }}'s Instagram Feed"><i class="fab fa-instagram fa-lg" aria-hidden="true"></i></a>
						<a href="{{ $market->brand->twitter }}" target="_blank" aria-label="View {{ $market->brand->name }}'s Twitter Feed"><i class="fab fa-twitter fa-lg" aria-hidden="true"></i></a>
						<a href="https://youtube.com/sunnydayguide" target="_blank" aria-label="View {{ $market->brand->name }}'s YouTube Channel"><i class="fab fa-youtube fa-lg" aria-hidden="true"></i></a>				
					</div>
					<ul class="list-unstyled footer-nav">
						<li><contact-form-modal></contact-form-modal></li>
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