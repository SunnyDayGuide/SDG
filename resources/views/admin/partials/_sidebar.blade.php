<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    @isset($market)
    <h5 class="text-uppercase d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      {{ $market->name }} 
      <span data-feather="sunset"></span>
    </h5>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('admin.market', $market->slug) }}">
          <span data-feather="home"></span>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="shopping-bag"></span>
          Advertisers
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.articles.index', $market->slug) }}">
          <span data-feather="file-text"></span>
          Articles
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="calendar"></span>
          Events
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="scissors"></span>
          Coupons
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="aperture"></span>
          Logos?
        </a>
      </li>
    </ul>
    @endisset

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      Superadmin Only
        <span data-feather="settings"></span>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.markets.index') }}">
          <span data-feather="book-open"></span>
          Markets
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
          <span data-feather="clipboard"></span>
          Categories
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tags.index') }}">
          <span data-feather="tag"></span>
          Tags
        </a>
      </li>      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="users"></span>
          Users
        </a>
      </li>
    </ul>
  </div>
  </nav>