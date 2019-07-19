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
       <div class="navbar-nav-scroll" id="scroll">
        <ul class="navbar-nav mr-auto">
          <!-- Megamenu-->
          <li class="nav-item dropdown megamenu"><a class="nav-link dropdown-toggle" id="megamenu" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plan Your Trip</a>
            <div aria-labelledby="megamenu" class="dropdown-menu border-0 p-0 m-0">
              <div class="container">
                <div class="row bg-white rounded-0 m-0 shadow-sm">
                  <div class="col-lg-8 col-xl-8">
                    <div class="p-4">
                      <div class="row">
                        @foreach ($market->navCategories as $category)
                        <div class="col-lg-6 mb-4">
                          <div class="megamenu-heading"><a href="{{ $market->path().'/'.$category->slug }}">{{ $category->name }} <small class="text-muted">- ALL</small></a></div>
                          <ul class="list-unstyled bag-fields">
                            @foreach ($category->navSubcategories as $subcategory)
                            <li class="nav-item bag-field"><a href="{{ $market->path().'/'.$category->slug.'/'.$subcategory->slug }}" class="nav-link text-small pb-0">{{ $subcategory->name }} - {{ $subcategory->advertisers_count }}</a></li>
                            @endforeach
                          </ul>
                        </div>
                        @endforeach
                      </div>
                      <div class="row mt-2">
                        <div class="col-lg-3">
                          <h6 class="megamenu-heading"><a href="#">Places to Stay</a></h6>
                          <h6 class="megamenu-heading"><a href="#">Local Info</a></h6>
                          <h6 class="megamenu-heading"><a href="#">Tide Charts</a></h6>
                        </div>
                        <div class="col-lg-9 mt-4 mt-md-0">
                          <div class="row">
                            <div class="col-6 col-md-9">
                              <h4 class="guide-link"><a href="{{ route('vacation-guide.create', $market->slug) }}">Free Digital Vacation Guide</a></h4>
                              <p class="nav-item">
                                Bacon ipsum dolor amet jerky ground round short loin. Cow swine pig turkey pork loin tail.
                              </p>
                            </div>
                            <div class="col position-relative">
                              <a href="{{ route('vacation-guide.create', $market->slug) }}">
                                <img src="{{ asset('images/'.$market->slug.'/guide-cover.jpg') }}" alt="{{ $market->brand->name }}" class="img-fluid nav-guide">                                
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-xl-4 px-0 d-none d-lg-block bg-highlight"></div>
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

        </div> <!-- End #scroll -->


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
      </ul>


    </div> <!-- End #navbarContent -->
  </div>
</nav>
</header>