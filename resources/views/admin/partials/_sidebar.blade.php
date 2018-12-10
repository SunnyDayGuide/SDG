<nav class="col-sm-3 col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    @isset($market)
    <h5 class="text-uppercase d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      {{ $market->name }} 
    </h5>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.market', $market->slug) }}">
          <i class="mr-1 fas fa-tachometer-alt"></i>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mr-1 fas fa-ad"></i>
          Advertisers
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mr-1 fas fa-bed"></i>
          Lodging
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.articles.index', $market->slug) }}">
          <i class="mr-1 fas fa-file"></i>
          Articles
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mr-1 fas fa-calendar"></i>
          Events
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mr-1 fas fa-cut"></i>
          Coupons
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mr-1 fas fa-quidditch"></i>
          Logos
        </a>
      </li>
    </ul>
    @endisset

    <h5 class="text-uppercase d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      Superadmin Only
        <i class="fas fa-user-secret"></i>
    </h5>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.markets.index') }}">
          <i class="mr-1 fas fa-book-open"></i>
          Markets
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
          <i class="mr-1 fas fa-list"></i>
          Categories
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tags.index') }}">
          <i class="mr-1 fas fa-tag"></i>
          Tags
        </a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
          <i class="mr-1 fas fa-user"></i>
          Users
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.departments.index') }}">
          <i class="mr-1 fas fa-users"></i>
          Departments
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.freemails.index') }}">
          <i class="mr-1 fas fa-mail-bulk"></i>
          Freemail
        </a>
      </li>
    </ul>
  </div>
  </nav>