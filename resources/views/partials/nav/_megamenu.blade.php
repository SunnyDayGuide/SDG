<li class="nav-item dropdown megamenu px-3">
	<a class="nav-link dropdown-toggle" id="megamenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plan Your Trip</a>
	<div aria-labelledby="megamenu" class="dropdown-menu border-0 p-0 m-0">
		<div class="container">
			<div class="row bg-white rounded-0 m-0 shadow">
				<!-- Left Side Of Megamenu -->
				@if(count($navCategories) < 4)
				@include('partials.nav._mega-left-std')
				@else
				@include('partials.nav._mega-left-alt')
				@endif

				<!-- Right colored block of megamenu -->
				<div class="col-lg-4 col-xl-4 p-3 d-none d-lg-block bg-highlight">
					<div class="nav-articles">
						<div class="mb-2">
							{{-- Temporary if statement. Remove for production. --}}
							@if(count($navArticles) > 0)
							<a href="{{ $featuredArticle->path() }}">
							@include('partials._images', ['item' => $featuredArticle])
							</a>
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