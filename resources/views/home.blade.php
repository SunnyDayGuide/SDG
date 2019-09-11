<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
  @yield('meta')

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

  <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('vendor/slick/slick-theme.css') }}" rel="stylesheet" type="text/css" />
  <script src="{{ asset('vendor/fontawesome/js/all.min.js') }}"></script>

</head>
<body>
  <div id="app" class="home">
    <!--Main Navigation-->
    <header>

      <!--Mask-->
      <div id="intro" class="view">

        <div class="mask">

          <div class="container d-flex flex-column justify-content-between h-100">

            <!--Navbar-->
            <nav class="navbar row d-flex flex-column flex-md-row justify-content-between mt-md-5">
              <!-- Desktop Logos -->
              <div class="logo-wrapper col-6 col-md-4 col-lg-3 mb-2 mb-md-0">
                <div class="d-none d-md-block">
                  <a class="navbar-brand mr-4 clearfix w-100" href="{{ url('/') }}">
                    <img src="{{ asset('images/main/SDG-header-logo.svg') }}" alt="Sunny Day Guide logo" class="img-fluid">
                  </a>
                </div>
                <!-- Mobile Logos -->
                <div class="d-md-none d-sm-block">
                  <a class="navbar-brand mr-4 clearfix w-100" href="{{ url('/') }}">
                    <img src="{{ asset('images/main/SDG-logo.svg') }}" alt="Sunny Day Guide Logo" class="img-fluid">
                  </a>
                </div>
              </div>

              <div class="home-nav col col-md-6">
                <a id="marketDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <i class="fas fa-angle-right"></i> Choose Your Vacation Destination 
                </a>
                <div class="dropdown-menu" aria-labelledby="marketDropdown">
                  @foreach ($markets as $market)
                  <a class="dropdown-item" href="{{ route('market.home', $market->slug) }}">{{ $market->name }}, {{ $market->state->name }}</a>
                  @endforeach
                </div>
              </div>
            </nav>

            
            <div class="row text-center">

              <div class="col-md-10 offset-md-1">

                <!-- Heading -->
                <div class="jumbo-header">
                  <h1 class="mb-5">Plan Your Ultimate Family Vacation!</h1>

                  <!-- Divider -->
                  <hr>

                  <!-- Description -->
                  <h4 class="my-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Deleniti
                  consequuntur.</h4>
                </div>

              </div>  <!-- End Column -->

            </div> <!-- End Row -->

          </div> <!-- End Container -->

        </div>

      </div>
      <!--/.Mask-->

    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="mt-5">
      <div class="container">

        <!--Section: Main Words-->
        <section id="best-features" class="text-center">

          <!-- Heading -->
          <div class="home-header mb-5">
            <h1 class="font-weight-bold">The Official Vacation Guide for Family Fun</h1>
            <h3>Activities, Restaurants, Shopping, Entertainment & More</h3>
          </div>

          <!--Grid row-->
          <div class="row d-flex justify-content-center mb-4">

            <!--Grid column-->
            <div class="col-md-8">

              <!-- Description -->
              <p>Chicken shoulder pork landjaeger tail sausage. Salami bresaola corned beef, tongue turkey jerky bacon. Tongue tri-tip pastrami burgdoggen, pancetta boudin beef prosciutto tenderloin frankfurter drumstick. Pork loin sirloin pork shankle pig bacon.</p>

            </div>
            <!--Grid column-->

          </div>
          <!--Grid row-->

          <!--Grid row-->
          <div class="row">

            <!--Grid column-->
            <div class="col-md-4 mb-5">
              <i class="fa fa-biking fa-4x text-advertiser"></i>
              <h4 class="my-4 font-weight-bold">Explore</h4>
              <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.</p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-1">
              <i class="fa fa-umbrella-beach fa-4x text-advertiser"></i>
              <h4 class="my-4 font-weight-bold">Relax</h4>
              <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.</p>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-1">
              <i class="fa fa-camera-retro fa-4x text-advertiser"></i>
              <h4 class="my-4 font-weight-bold">Experience</h4>
              <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores nam, aperiam minima assumenda deleniti hic.</p>
            </div>
            <!--Grid column-->

          </div>
          <!--Grid row-->

        </section>
        <!--Section: Best Features-->

        <hr class="my-5">

        <!--Section: Examples-->
        <section id="examples" class="text-center">

          <!-- Heading -->
          <h2 class="mb-5 font-weight-bold">11 Destinations - 8 States - Over 28 Cities</h2>

          @include('partials._homeMktGrid')

        </section>
        <!--Section: Examples-->

        <hr class="my-5">

        <!--Section: More Copy-->
        <section class="mb-5">
          <h2 class="mb-5 font-weight-bold text-center">Another Heading - Something Great About Coupons</h2>
          <p>Chicken shoulder pork landjaeger tail sausage. Salami bresaola corned beef, tongue turkey jerky bacon. Tongue tri-tip pastrami burgdoggen, pancetta boudin beef prosciutto tenderloin frankfurter drumstick. Pork loin sirloin pork shankle pig bacon.</p>
          <p>Bacon ipsum dolor amet short loin ground round doner beef. Jerky drumstick tongue pork sausage cupim pancetta beef kevin salami cow spare ribs tenderloin. Cow flank andouille chuck, chicken sausage shankle pig leberkas fatback swine alcatra shank pancetta venison. Turkey ball tip pastrami fatback landjaeger. Spare ribs jerky boudin, cupim kielbasa pork loin corned beef landjaeger. Swine ribeye landjaeger beef ribs, strip steak turducken bresaola meatloaf.</p>
          <p>Filet mignon pork chop t-bone, short loin sirloin shank venison drumstick kevin pork loin pork brisket. Cow ground round chuck meatloaf leberkas tri-tip picanha shank short ribs tenderloin boudin turducken venison ham hock shankle. Chicken t-bone boudin drumstick strip steak beef. Pork pork loin tongue, bacon pastrami brisket fatback beef ribs. Biltong andouille meatloaf kielbasa ham hock sausage buffalo meatball doner bresaola ground round. Pancetta chicken leberkas sirloin kevin, ball tip bacon frankfurter cupim salami pork chop.</p>
        </section>

      </div>
      <!-- Related Articles Section -->
      <section class="panel related-articles mt-5">
        <div class="container">

          <h2 class="mb-4 font-weight-bold text-center">Let Us Tempt You! - Or a More Clever Headline</h2>

          <div class="row article-cards">
            <div class="card-deck w-100 mx-md-0">
              @foreach ($relatedArticles as $relatedArticle)
              @include('panels._articles')
              @endforeach
            </div> <!-- End Card Deck-->
          </div> <!-- End Row-->      

        </div>
      </section> <!-- End Related Articles Section -->

    </main>
    <!--Main layout-->

    <!-- Footer -->
    <footer>
      <div class="footer">
        <div class="container">
          <div class="row justify-content-between">

            <div class="col-md-5 mb-4 mb-md-0">
              <h4 class="pb-2">Visit Any of these Great Vacation Destinations</h4>
              <div class="row pl-2">
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

            <div class="col-md-3 mr-0 mb-4 mb-md-0 text-center text-md-left">
              <h4 class="pb-2">Connect With Us</h4>
              <div class="social pb-2 pl-2">
                <a href="https://www.facebook.com/sunnydayguide" target="_blank" aria-label="View Sunny Day Guide's Facebook page"><i class="fab fa-facebook fa-lg" aria-hidden="true"></i></a> 
                <a href="https://www.instagram.com/sunnydayguide" target="_blank" aria-label="View Sunny Day Guide's Instagram Feed"><i class="fab fa-instagram fa-lg" aria-hidden="true"></i></a>
                <a href="https://twitter.com/sunnydayguide" target="_blank" aria-label="View Sunny Day Guide's Twitter Feed"><i class="fab fa-twitter fa-lg" aria-hidden="true"></i></a>
                <a href="https://youtube.com/sunnydayguide" target="_blank" aria-label="View Sunny Day Guide's YouTube Channel"><i class="fab fa-youtube fa-lg" aria-hidden="true"></i></a>        
              </div>
              <ul class="list-unstyled footer-nav pl-2">
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Request More Information</a></li>
                <li><a href="https://sunnydaysolutions.com" target="_blank">Advertise With Us</a></li>
              </ul>
            </div>

            <div class="col-md-3 ml-0 mb-4 mb-md-0 text-center text-md-left">
              <a href="{{ route('home') }}">
                <img src="{{ asset('images/main/SDG-footer-logo.svg') }}" alt="Sunny Day Guide logo" class="w-auto">
              </a>
              <address class="mt-4 pl-md-2">
                800 Seahawk Circle, Suite 106<br>
                Virginia Beach, Virginia 23452<br>
                <strong>1-800-786-6932</strong>
              </address>
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
    <!-- Footer -->
  </div>

  <!-- Scripts -->
  <script src="{{ mix('js/manifest.js') }}"></script>
  <script src="{{ mix('js/vendor.js') }}"></script>
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="{{ asset('vendor/slick/slick.min.js') }}"/></script>

</body>
</html>