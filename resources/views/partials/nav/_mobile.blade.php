<!-- Mobile -->
<div class="mobile-nav d-md-none pb-5">
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
                <a class="dropdown-item subcategory-item" href="{{ $market->path() }}/entertainment-shows#show-schedule"><i class="fas fa-calendar-alt fa-sm mr-2"></i>Show Schedule</a>
                @endif
            </div>
        </li>
        @endforeach
        <a class="nav-link menu-item-title py-3 pl-3" href="{{ $market->path() }}/accommodations">Places to Stay</a>
    </ul>

    <!-- Other Page Links -->
    <div class="bg-editorial mb-4 mx-n3 px-3">
        <ul class="nav justify-content-left my-2">
            <li class="nav-item text-white"><a class="nav-link text-reset" href="{{ route('coupons', $market) }}">Coupons</a></li>
            <li class="nav-item text-white"><a class="nav-link text-reset" href="{{ route('events', $market) }}">Events</a></li>
        </ul>

        <ul class="nav justify-content-left my-2">
            <li class="nav-item text-white"><a class="nav-link text-reset" href="{{ route('articles', $market) }}">Trip Ideas</a></li>
            <li class="nav-item text-white"><a class="nav-link text-reset" href="{{ route('visitor-info', $market) }}">Visitor Info</a></li>
            @unless($market->code == 'BR' || $market->code == 'SM' || $market->code == 'CG')
            <li class="nav-item text-white"><a class="nav-link text-reset" href="{{ route('tide-charts', $market) }}">Tide Charts</a></li>
            @endunless
        </ul>
    </div>

    <nav-weather weather-city="{{ $market->weatherId }}" route="{{ route('weather', $market) }}"></nav-weather>

     <!-- Digital Guide -->
    <div class="megamenu-block megamenu-guide mt-1">
        <div class="row">
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
    <ul class="navbar-nav menu-group-primary">
        <li class="nav-item dropdown">
            <a id="marketDropdown" class="nav-link dropdown-toggle menu-item-title" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Other Destinations</a>
            <div class="dropdown-menu">
                @foreach ($markets as $navMarket)
                <a class="dropdown-item subcategory-item" href="{{ route('market.home', $navMarket->slug) }}">{{ $navMarket->name_long }}</a>
                @endforeach
            </div>
        </li>
    </ul>
</div>