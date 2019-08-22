<header>
    @include('partials.nav._top')
    <nav class="navbar navbar-expand-xl navbar-dark bg-primary">
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

            <div id="navbarContent" class="collapse navbar-collapse justify-content-between">      
                <!-- Desktop -->              
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto d-none d-md-flex justify-content-between">
                    <!-- Megamenu-->
                    @include('partials.nav._megamenu')

                    <li class="nav-item px-3">
                        <a class="nav-link" href="{{ route('coupons', $market) }}">Coupons</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link" href="{{ route('events', $market) }}">Events</a>
                    </li>

                    <li class="nav-item px-3">
                        <a class="nav-link" href="{{ route('articles', $market) }}">Trip Ideas</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto d-none d-md-flex">
                    <nav-weather weather-city="{{ $market->weatherId }}"></nav-weather>

                    <li class="align-self-center bucket-list">
                        <a href="#">Bucket List</a>
                    </li>
                </ul>

                @include('partials.nav._mobile')

            </div> <!-- End #navbarContent -->

        </div> <!-- End container -->
    </nav>
</header>