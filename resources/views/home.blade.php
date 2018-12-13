@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12-md">

            <div class="jumbotron">
              <h1 class="display-4">Hello, world!</h1>
              <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
              <hr class="my-4">
              <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
              <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </div>

      </div>  <!-- End Column -->
  </div> <!-- End Row -->

  <div class="row">
      <div class="col-12-md">
        <nav class="nav flex-column">
            @foreach ($markets as $market)
            <a class="nav-link" href="{{ route('market.home', $market) }}">{{ $market->name }}</a>
            @endforeach
        </nav>
      </div>  <!-- End column -->
  </div> <!-- End Row -->

</div>  <!-- End Container -->

@endsection