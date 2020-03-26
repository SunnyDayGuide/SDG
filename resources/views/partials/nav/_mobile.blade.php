<!-- Mobile -->
<div class="mobile-nav d-md-none">
    <!-- Mobile Top -->
    <div class="nav-market">
        <a class="text-reset" href="{{ route('market.home', $market->slug) }}">
            <i class="fas fa-home fa-sm mr-2"></i>Plan your trip to <span class="market-name">{{ $market->name_long }}</span>
        </a>
    </div>    

    <!-- Categories -->
    <ul class="navbar-nav menu-group-primary">
        @foreach ($navCategories as $category)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle menu-item-title" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $category->name }}</a>
            <div class="dropdown-menu">
                <a class="dropdown-item category-home text-white" href="{{ $market->path().'/'.$category->slug }}"><i class="fas fa-home fa-sm mr-2"></i>{{ $category->name }} Home</a>
                @foreach ($category->navSubcategories->sortBy('name') as $subcategory)
                <a class="dropdown-item subcategory-item" href="{{ $market->path().'/'.$category->slug.'/'.$subcategory->slug }}">{{ $subcategory->name }}</a>
                @endforeach
                @if($market->code == 'BR' && $category->id == 4)
                <a class="dropdown-item subcategory-item text-white" href="{{ $market->path() }}/entertainment-shows#show-schedule"><i class="fas fa-calendar-alt fa-sm mr-2"></i>Show Schedule</a>
                @endif
            </div>
        </li>
        @endforeach

        <li class="nav-item">
            <a class="nav-link menu-item-title py-3 pl-4" href="{{ $market->path() }}/accommodations">Places to Stay</a>
        </li>

        <li class="nav-item coupon-bar">
            <a class="menu-item-title" href="{{ route('coupons', $market) }}">
                <i class="fas fa-dollar-sign fa-sm fa-fw mr-1"></i>Coupons &amp; Special Deals
            </a>
        </li> 
        
        <!-- Other Page Links -->
        <li class="nav-item pages-bar d-flex d-md-none flex-wrap my-2">
            <a class="nav-link menu-item-title pl-4" href="{{ route('events', $market) }}">Events</a>
            <a class="nav-link menu-item-title pl-4" href="{{ route('articles', $market) }}">Trip Ideas</a>
            <a class="nav-link menu-item-title pl-4" href="{{ route('visitor-info', $market) }}">Visitor Info</a>
            @unless($market->code == 'BR' || $market->code == 'SM' || $market->code == 'CG')
            <a class="nav-link menu-item-title pl-4" href="{{ route('tide-charts', $market) }}">Tide Charts</a>
            @endunless
        </li>
    </ul>

    {{-- <nav-weather weather-city="{{ $market->weatherId }}" route="{{ route('weather', $market) }}"></nav-weather> --}}

     <!-- Digital Guide -->
    <div class="megamenu-guide mt-2">
        <div class="row no-gutters align-items-center">
            <div class="col-4">
                <a href="{{ route('vacation-guide.create', $market->slug) }}" class="guide-image">
                    {{ $market->getFirstMedia('cover') }}
                </a>
            </div>

            <div class="col-8">
                <div class="guide-text">
                    <h4 class="guide-link"><a href="{{ route('vacation-guide.create', $market->slug) }}">Free Digital Vacation Guide</a></h4>
                    <p class="nav-item text-white">
                        Bacon ipsum dolor amet jerky ground round short loin. Cow swine pig turkey pork loin tail.
                    </p>
                </div>
            </div>
        </div>
    </div>

     <!-- Other Destinations -->
{{--     <ul class="navbar-nav menu-group-primary">
        <li class="nav-item dropdown">
            <a id="marketDropdown" class="nav-link dropdown-toggle menu-item-title" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Other Destinations</a>
            <div class="dropdown-menu">
                @foreach ($markets as $navMarket)
                <a class="dropdown-item subcategory-item" href="{{ route('market.home', $navMarket->slug) }}">{{ $navMarket->name_long }}</a>
                @endforeach
            </div>
        </li>
    </ul> --}}
</div>