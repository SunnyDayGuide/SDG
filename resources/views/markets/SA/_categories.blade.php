<h2>Discover the best of {{ $market->name }}</h2>
<div class="card-columns">
	<div class="card text-white overlay text-left">
		<img src="{{ asset('images/branson/home/entertainment-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay">
			<a href="{{ $market->path().'/entertainment' }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Entertainment & Shows</h3>
			</a>
			<p class="card-text">Chicken ribeye swine leberkas hamburger jerky.</p>
		</div>
	</div>	
	<div class="card text-white overlay text-left">
		<img src="{{ asset('images/branson/home/activities-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay">
			<a href="{{ $market->path().'/things-to-do' }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Things to Do</h3>
			</a>
			<p class="card-text">This is one short blurb about Activities.</p>
		</div>
	</div>
	<div class="card text-white overlay text-right">
		<img src="{{ asset('images/branson/home/shopping-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay d-flex flex-column justify-content-end">
			<a href="{{ $market->path().'/shopping' }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Shopping</h3>
			</a>
			<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
		</div>
	</div>
	<div class="card text-white overlay text-left">
		<img src="{{ asset('images/branson/home/events-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay">
			<a href="{{ route('events', $market) }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Events</h3>
			</a>
			<p class="card-text">Chicken ribeye swine leberkas hamburger jerky.</p>
		</div>
	</div>
	<div class="card text-white overlay text-left">
		<img src="{{ asset('images/branson/home/dining-inset.jpg') }}" class="card-img" alt="...">
		<div class="card-img-overlay">
			<a href="{{ $market->path().'/restaurants' }}" class="stretched-link text-reset text-decoration-none">
				<h3 class="card-title">Restaurants</h3>
			</a>
			<p class="card-text">Chicken ribeye swine leberkas hamburger jerky.</p>
		</div>
	</div>
</div>