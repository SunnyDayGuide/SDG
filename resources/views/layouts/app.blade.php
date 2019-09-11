<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    @yield('meta')

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/slick/slick-theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/weather-icons/css/weather-icons.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('vendor/fontawesome/js/all.min.js') }}"></script>

    <!-- CSS rules for styling the element inside the editor such as p, h1, h2, etc. -->
    <link href="{{ asset('css/vendor/froala_styles.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('styles')

</head>
<body>
    <div id="app">
        @include('partials._nav3')

        <main role="main" class="content-wrapper">
            @yield('jumbotron')
            @yield('content')
        </main>
        
        @include('partials._prefooter')
        @include('partials._footer')
    </div>

<!-- Scripts -->
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('vendor/slick/slick.min.js') }}"/></script>
@yield('scripts')

</body>
</html>
