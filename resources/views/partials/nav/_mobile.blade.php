<!-- Mobile -->
<div class="mobile-nav d-md-none">
    <ul class="navbar-nav menu-group-primary">
        @foreach ($navCategories as $category)
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle menu-item-title" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $category->name }}</a>
            <div class="dropdown-menu">
                <a class="dropdown-item category-home text-white" href="{{ $market->path().'/'.$category->slug }}"><i class="fas fa-home fa-sm mr-2"></i>{{ $category->name }} home</a>
                @foreach ($category->navSubcategories->sortBy('name') as $subcategory)
                <a class="dropdown-item subcategory-item" href="{{ $market->path().'/'.$category->slug.'/'.$subcategory->slug }}">{{ $subcategory->name }}</a>
                @endforeach
            </div>
        </li>
        @endforeach
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item no-sub"><a class="nav-link" href="{{ route('coupons', $market) }}">Coupons</a></li>
        <li class="nav-item no-sub"><a class="nav-link" href="{{ route('events', $market) }}">Events</a></li>
        <li class="nav-item no-sub"><a class="nav-link" href="{{ route('articles', $market) }}">Trip Ideas</a></li>
    </ul>
</div>