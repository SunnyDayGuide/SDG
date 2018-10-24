<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sunny Day Guide') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

  </head>

  <body>
    @include ('admin.partials._nav')

    <div class="container-fluid">
      <div class="row">
        @include ('admin.partials._sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

            @yield('pageHeader')

          </div> <!-- End header content wrapping div -->

          <div class="pt-3 pb-2 mb-3">
              @yield('content')
          </div>

        </main>
      </div> <!-- End row -->
    </div> <!-- End container-fluid -->

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  
  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

  @yield('scripts')

  </body>
</html>
