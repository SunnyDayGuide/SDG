<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand mr-4 clearfix" href="{{ url('/') }}">
                <img src="{{ asset($market->brand->logo) }}" alt="{{ $market->brand->name }}" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTop">
                <!-- Left Side Of Navbar -->
                <div class="navbar-nav-scroll">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a id="categoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Plan Your Trip <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                            @foreach ($market->categories as $category)
                            <a href="{{ $market->path().'/'.$category->slug }}" class="dropdown-item">{{ $category->name }}</a>
                                <ul>
                                @foreach ($category->children as $subcategory)
                                <li><a href="{{ $market->path().'/'.$category->slug.'/'.$subcategory->slug }}">{{ $subcategory->name }}</a></li>
                                @endforeach
                                </ul>
                            @endforeach
                        </div>
                    </li> 

                    <li class="nav-item">
                        <a class="nav-link" href="#">Coupons</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events', $market) }}">Events</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles', $market) }}">Trip Ideas</a>
                    </li>

                </ul>
                </div>

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
            </div>
        </div>
    </nav>
</header>
