<h2>Discover the best of {{ $market->name }}</h2>
<div class="card-columns category-gallery">
	<div class="card text-white overlay text-left">
		<img src="{{ asset('storage/images/outer-banks/home/activities-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay">
			<a href="{{ $market->path().'/things-to-do' }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Things to Do</h3>
			</a>
			<p class="card-text">Exhilarating watersports, outdoor adventures, and loads of other attractions and activities!</p>
		</div>
	</div>
	<div class="card text-white overlay text-left">
		<img src="{{ asset('storage/images/outer-banks/home/dining-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay d-flex flex-column justify-content-end">
			<a href="{{ $market->path().'/restaurants' }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Restaurants</h3>
			</a>
			<p class="card-text">Family-friendly dining everyone will love!</p>
		</div>
	</div>
	<div class="card text-white overlay text-left">
		<img src="{{ asset('storage/images/outer-banks/home/shopping-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay d-flex flex-column justify-content-end">
			<a href="{{ $market->path().'/shopping' }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Shopping</h3>
			</a>
			<p class="card-text">Find the perfect souvenir or gift.</p>
		</div>
	</div>
	<div class="card text-white overlay text-left">
		<img src="{{ asset('storage/images/outer-banks/home/accommodations-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay d-flex flex-column justify-content-end">
			<a href="{{ $market->path().'/accommodations' }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Places to Stay</h3>
			</a>
			<p class="card-text">Find your perfect hotel or beach house</p>
		</div>
	</div>	
	<div class="card text-white overlay text-left">
		<img src="{{ asset('storage/images/outer-banks/home/events-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay d-flex flex-column justify-content-end">
			<a href="{{ route('events', $market) }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Events</h3>
			</a>
			<p class="card-text">What's happening on <br>the Outer Banks this week?</p>
		</div>
	</div>

</div>