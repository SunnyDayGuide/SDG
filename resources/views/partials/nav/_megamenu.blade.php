<li class="nav-item dropdown megamenu">
	<a class="nav-link dropdown-toggle" id="megamenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plan Your Trip</a>
	<div aria-labelledby="megamenu" class="dropdown-menu border-0 p-0 m-0">
		<div class="container">
			<div class="row bg-white rounded-0 m-0 shadow">
				<!-- Left Side Of Megamenu -->
				<div class="col-lg-8 col-xl-8">
					<div class="pt-4 px-2">
						<div class="row">
							@foreach ($navCategories as $category)
							<div class="col-lg-6 mb-4">
								<div class="megamenu-heading">
									<a href="{{ $market->path().'/'.$category->slug }}">{{ $category->name }}</a>
								</div>
								<ul class="list-unstyled subcategories">
									{{-- @foreach ($category->navSubcategories->take(7)->sortBy('name') as $subcategory) --}}
									@foreach ($category->navSubcategories->sortBy('name') as $subcategory)
									<li class="nav-item subcategory"><a href="{{ $market->path().'/'.$category->slug.'/'.$subcategory->slug }}" class="nav-link text-small pb-0">{{ $subcategory->name }}</a></li>
									@endforeach
									<li class="nav-item subcategory"><a href="{{ $market->path().'/'.$category->slug }}" class="btn-nav btn btn-sm btn-light text-white ml-1 mt-2 more">More</a></li>
								</ul>
							</div>
							@endforeach
							@if(count($navCategories) < 4)
							<div class="col-lg-6 mb-4">
								@if($market->code == 'BR')
								<div class="megamenu-heading"><a href="#">Show Schedule</a></div>
								@endif
								<div class="megamenu-heading"><a href="#">Places to Stay</a></div>
								<div class="megamenu-heading"><a href="#">Local Info</a></div>
								<div class="megamenu-heading"><a href="#">Tide Charts</a></div>
							</div>
							@endif
						</div> <!-- End row -->

						<!-- Bottom left of megamenu -->
						<div class="row mt-4 megamenu-bottom">
							<!-- Vacation Guide -->
							<div class="col-lg-9 mt-4 mt-md-0">
								<div class="row  position-relative">
									<div class="col">
										<a href="{{ route('vacation-guide.create', $market->slug) }}" class="nav-guide">
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
								<h6 class="megamenu-heading megamenu-subheading"><a href="#">Show Schedule</a></h6>
								@endif
								<h6 class="megamenu-heading megamenu-subheading"><a href="#">Places to Stay</a></h6>
								<h6 class="megamenu-heading megamenu-subheading"><a href="#">Local Info</a></h6>
								
								<h6 class="megamenu-heading megamenu-subheading"><a href="{{ route('tide-charts', $market) }}">Tide Charts</a></h6>
								
							</div>
						</div> <!-- End row -->
					</div>
				</div>

				<!-- Right colored block of megamenu -->
				<div class="col-lg-4 col-xl-4 p-3 d-none d-lg-block bg-highlight">
					<div class="nav-articles">
						<div class="mb-2">
							{{-- Temporary if statement. Remove for production. --}}
							@if(count($navArticles) > 0)
							@include('partials._images', ['item' => $featuredArticle])
							@endif
						</div>
						<ul class="list-unstyled ml-2">
							@foreach($navArticles as $navArticle)
							<li class="nav-item text-white">
								<a href="{{ $navArticle->path() }}" class="text-reset">
									{{ $navArticle->title }}
								</a>
							</li>
							@endforeach
						</ul>
						<a href="{{ route('articles', $market) }}" class="btn btn-advertiser btn-nav text-white mt-3">More Trip Ideas</a>
					</div>
					<hr class="border-bottom border-white my-4">
					<div class="nav-events">
						<div class="megamenu-heading text-white">Upcoming Events</div>
						<ul class="list-unstyled ml-2">
							@foreach($navEvents as $navEvent)
							<li class="nav-item text-white"><span class="font-weight-bolder mr-2">{{ $navEvent->navRange }}</span> {{ $navEvent->title }}</li>
							@endforeach
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>
</li>