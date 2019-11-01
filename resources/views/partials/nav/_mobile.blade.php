<!-- Mobile -->
<div class="mobile-nav d-md-none">
    <!-- Mobile Top -->
    <div class="nav-market">
        <a class="text-reset" href="{{ route('market.home', $market->slug) }}">
            Plan your trip to <span class="market-name">{{ $market->name_long }}</span>
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
            </div>
        </li>
        @endforeach
    </ul>

    <!-- Other Page Links -->
    <ul class="navbar-nav">
        <li class="nav-item no-sub"><a class="nav-link" href="{{ route('coupons', $market) }}">Coupons</a></li>
        <li class="nav-item no-sub"><a class="nav-link" href="{{ route('events', $market) }}">Events</a></li>
        <li class="nav-item no-sub"><a class="nav-link" href="{{ route('articles', $market) }}">Trip Ideas</a></li>
    </ul>

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