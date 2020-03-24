<!-- Desktop -->              
<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto d-none d-xl-flex justify-content-between">
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
<div class="navbar-nav ml-auto d-none d-xl-flex">
    <nav-weather weather-city="{{ $market->weatherId }}" route="{{ route('weather', $market) }}"></nav-weather>

    <div class="align-self-center bucket-list-container d-block">
        <div class="bucket-list-wrapper">
            <div class="bucket-tab">
                <a href="{{ route('bucket-list', $market) }}" class="bucket-content text-reset text-decoration-none">
                    <div class="bucket-text text-center">Bucket List</div>
                    <bucket-counter bucket-id="{{ $bucketId }}" initial-count="{{ $item_count }}" location="desktop"></bucket-counter>
                </a>
            </div>
            
        </div>
    </div>
</div>