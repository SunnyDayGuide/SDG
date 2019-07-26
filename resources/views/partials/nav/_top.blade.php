<div class="navbar-top">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <!-- Left Side Of Navbar -->
            <div class="nav-market">
                <span class="market-name">{{ $market->name_long }}</span>
                @if($market->cities)
                <span class="cities d-none d-md-inline"> - {{ $market->cities }}</span> 
                @endif
            </div>
            
            <!-- Right Side Of Navbar -->
            <div class="d-flex">
                <div class="dropdown d-none d-md-inline">
                    <a id="marketDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Other Destinations <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right rounded-0 border-0 m-0" aria-labelledby="marketDropdown">
                        @foreach ($markets as $navMarket)
                        <a class="dropdown-item" href="{{ route('market.home', $navMarket->slug) }}">{{ $navMarket->name_long }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="nav-item">
                    <a class="nav-link pr-0" href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </div>

            </div> <!-- End Right Side Of Navbar -->
        </div>
    </div>
</div>