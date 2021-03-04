<header class="fixed-top">
    @include('partials.nav._top')
    <nav class="navbar navbar-expand-xl navbar-dark bg-primary">
        <div class="container">
            <!-- Branding -->
            <div id="branding">
                <!-- Desktop Logos -->
                <div class="d-none d-md-block">
                    <a class="navbar-brand mr-4 clearfix" href="{{ url('/') }}">
                        @if($market->code == 'SM')
                        <img src="{{ asset('storage/images/main/WTD-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
                        @elseif($market->code == 'CG')
                        <img src="{{ asset('storage/images/main/CG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
                        @else
                        <img src="{{ asset('storage/images/main/SDG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
                        @endif
                    </a>
                </div>
                <!-- Mobile Logos if we do a diff logo here for mobile. Otherwise just use what's up top-->
                <div class="d-md-none d-sm-block">
                    <a class="navbar-brand clearfix mr-0" href="{{ url('/') }}">
                        @if($market->code == 'SM')
                        <img src="{{ asset('storage/images/main/WTD-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
                        @elseif($market->code == 'CG')
                        <img src="{{ asset('storage/images/main/CG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
                        @else
                        <img src="{{ asset('storage/images/main/SDG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid">
                        @endif
                    </a>
                </div>
            </div> <!-- End #branding -->
            
            <!-- Mobile and Tablet nav buttons -->
            <div class="d-flex align-items-center d-xl-none">
                <div class="nav-item text-white">
                    <a class="nav-link text-reset px-0" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </div>

                <a href="{{ route('bucket-list', $market) }}" class="bucket-content text-reset text-decoration-none ml-4">
                    <bucket-counter bucket-id="{{ $bucketId }}" initial-count="{{ $item_count }}" location="mobile"></bucket-counter>
                </a>

                <button type="button" data-toggle="offcanvas" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="hamburger-nav ml-4">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <div class="navbar-collapse offcanvas-collapse justify-content-between">      
                @include('partials.nav._desktop')
                @include('partials.nav._tablet')
                @include('partials.nav._mobile')
            </div> <!-- End #navbarContent -->

        </div> <!-- End container -->
    </nav>
</header>