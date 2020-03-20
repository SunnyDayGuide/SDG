<div class="col-lg-8 col-xl-8">
	<div class="megamenu-alt pt-4 px-2">
		<div class="row nav-categories">
			@foreach ($navCategories as $category)
			<div class="col-lg-6 megamenu-block">
				<div class="megamenu-heading">
					<a href="{{ $market->path().'/'.$category->slug }}">{{ $category->name }}</a>
				</div>
				<ul class="list-unstyled subcategories">
					@foreach ($category->navSubcategories->take(7)->sortBy('name') as $subcategory)
					{{-- @foreach ($category->navSubcategories->sortBy('name') as $subcategory) --}}
					<li class="nav-item subcategory"><a href="{{ $market->path().'/'.$category->slug.'/'.$subcategory->slug }}" class="nav-link text-small pb-0">{{ $subcategory->name }}</a></li>
					@endforeach
					<li class="nav-item subcategory"><a href="{{ $market->path().'/'.$category->slug }}" class="btn-nav btn btn-sm btn-light text-white ml-1 mt-2 more">More</a></li>
				</ul>
			</div>
			@endforeach
		</div> <!-- End row -->

		<!-- Bottom left of megamenu -->
		<div class="row mt-4 megamenu-bottom">
			<!-- Vacation Guide -->
			<div class="col-lg-9 mt-4 mt-md-0">
				<div class="row">
					<div class="col">
						<a href="{{ route('vacation-guide.create', $market->slug) }}" class="guide-image">
							{{ $market->getFirstMedia('cover') }}
						</a>
					</div>

					<div class="col-6 col-md-9">
						<div class="ml-3">
							<h4 class="guide-link"><a href="{{ route('vacation-guide.create', $market->slug) }}">Free Digital Vacation Guide</a></h4>
							<p class="nav-item">
								Bacon ipsum dolor amet jerky ground round short loin. Cow swine pig turkey pork loin tail.
							</p>
						</div>
					</div>

				</div>
			</div>

			<!-- Bottom submenu -->
			<div class="col-lg-3">
				@if($market->code == 'BR')
				<h6 class="megamenu-heading megamenu-subheading"><a href="{{ $market->path() }}/entertainment-shows#show-schedule">Show Schedule</a></h6>
				@endif
				<h6 class="megamenu-heading megamenu-subheading"><a href="{{ $market->path() }}/accommodations">Places to Stay</a></h6>
				<h6 class="megamenu-heading megamenu-subheading"><a href="{{ route('visitor-info', $market) }}">Visitor Info</a></h6>

				@unless($market->code == 'BR' || $market->code == 'SM' || $market->code == 'CG')
				<h6 class="megamenu-heading megamenu-subheading"><a href="{{ route('tide-charts', $market) }}">Tide Charts</a></h6>
				@endunless

			</div>
		</div> <!-- End row -->
	</div>
</div>