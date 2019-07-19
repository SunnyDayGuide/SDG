<header class="row mx-auto thenavbar px-0">
	<nav class="col navbar navbar-expand-lg navbar-dark fixed-top mx-auto">
		<div class="row mx-auto menu">
            <!-- Desktop Logos -->
            <div class="d-none d-md-block">
                <a class="navbar-brand mr-4 clearfix" href="{{ url('/') }}">
                    @if($market->code == 'SM')
                    <img src="{{ asset('images/main/WTD-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid logo">
                    @elseif($market->code == 'CG')
                    <img src="{{ asset('images/main/CG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid logo">
                    @else
                    <img src="{{ asset('images/main/SDG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid logo">
                    @endif
                </a>
            </div>
             <!-- Mobile Logos -->
            <div class="d-md-none d-sm-block">
                <a class="navbar-brand mr-4 clearfix" href="{{ url('/') }}">
                    @if($market->code == 'SM')
                    <img src="{{ asset('images/main/WTD-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid logo">
                    @elseif($market->code == 'CG')
                    <img src="{{ asset('images/main/CG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid logo">
                    @else
                    <img src="{{ asset('images/main/SDG-logo.svg') }}" alt="{{ $market->brand->name }}" class="img-fluid logo">
                    @endif
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" onclick="openNav()">
                <span class="navbar-toggler-icon"></span>
            </button>

            <ul class="sidenav main-menu" id="mySidenav">
            	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            	
            </ul>

		</div>
		
	</nav>
</header>