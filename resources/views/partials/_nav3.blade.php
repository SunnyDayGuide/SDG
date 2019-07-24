<header>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <!-- Branding -->
      <div id="branding">
        <!-- Desktop Logos -->
        <div class="d-none d-md-block">
          <a class="navbar-brand mr-4 clearfix" href="{{ url('/') }}">
            @if($market->code == 'SM')
            <img src="{{ asset('images/main/WTD-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
            @elseif($market->code == 'CG')
            <img src="{{ asset('images/main/CG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
            @else
            <img src="{{ asset('images/main/SDG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
            @endif
          </a>
        </div>
        <!-- Mobile Logos -->
        <div class="d-md-none d-sm-block">
          <a class="navbar-brand mr-4 clearfix" href="{{ url('/') }}">
            @if($market->code == 'SM')
            <img src="{{ asset('images/main/WTD-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
            @elseif($market->code == 'CG')
            <img src="{{ asset('images/main/CG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
            @else
            <img src="{{ asset('images/main/SDG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
            @endif
          </a>
        </div>
      </div> <!-- End #branding -->

      <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="navbarContent" class="collapse navbar-collapse">
       <!-- Left Side Of Navbar -->
       <ul class="navbar-nav mr-auto">
        <!-- Megamenu-->
        <li class="nav-item dropdown megamenu"><a class="nav-link dropdown-toggle" id="megamenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plan Your Trip</a>
          <div aria-labelledby="megamenu" class="dropdown-menu border-0 p-0 m-0">
            <div class="container">
              <div class="row bg-white rounded-0 m-0 shadow">
                <div class="col-lg-8 col-xl-8">
                  <div class="pt-4 px-2">
                    <div class="row">
                      @foreach ($navCategories as $category)
                      <div class="col-lg-6 mb-4">
                        <div class="megamenu-heading">
                          <a href="{{ $market->path().'/'.$category->slug }}">{{ $category->name }}</a>
                        </div>
                        <ul class="list-unstyled subcategories">
                          @foreach ($category->navSubcategories->take(7)->sortBy('name') as $subcategory)
                          <li class="nav-item subcategory"><a href="{{ $market->path().'/'.$category->slug.'/'.$subcategory->slug }}" class="nav-link text-small pb-0">{{ $subcategory->name }}</a></li>
                          @endforeach
                          <li class="nav-item subcategory"><a href="{{ $market->path().'/'.$category->slug }}" class="btn-nav btn btn-sm btn-light text-white ml-1 mt-2 more">More</a></li>
                        </ul>
                      </div>
                      @endforeach
                    </div>
                    <div class="row mt-4">
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
                      <div class="col-lg-3">
                        @if($market->code == 'BR')
                        <h6 class="megamenu-heading megamenu-subheading"><a href="#">Show Schedule</a></h6>
                        @endif
                        <h6 class="megamenu-heading megamenu-subheading"><a href="#">Places to Stay</a></h6>
                        <h6 class="megamenu-heading megamenu-subheading"><a href="#">Local Info</a></h6>
                        <h6 class="megamenu-heading megamenu-subheading"><a href="#">Tide Charts</a></h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-xl-4 p-3 d-none d-lg-block bg-highlight">
                  <div class="nav-articles">
                    <div class="mb-2">
                      {{-- Temporary if statement. Remove for production. --}}
                      @if(count($market->articles) > 0)
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

        <li class="nav-item">
          <a class="nav-link" href="{{ route('coupons', $market) }}">Coupons</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('events', $market) }}">Events</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('articles', $market) }}">Trip Ideas</a>
        </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto d-flex">

        <li class="nav-item dropdown mr-3 align-self-center">
          <a id="marketDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            Other Destinations <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="marketDropdown">
            @foreach ($markets as $market)
            <a class="dropdown-item" href="{{ route('market.home', $market->slug) }}">{{ $market->name }}</a>
            @endforeach
          </div>
        </li>

        <li class="align-self-center bucket-list">
          <a href="#">Bucket List</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="fas fa-search"></i>
          </a>
        </li>

      </ul>


    </div> <!-- End #navbarContent -->
  </div> <!-- End container -->
</nav>
</header>