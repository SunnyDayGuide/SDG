<div class="row no-gutters card-h card-article overlay position-relative">
  <div class="col-md-1">
    <slot name="completed"></slot>
  </div>
  <div class="col-md-6 mb-md-0">
    <a href="{{ $article->path() }}">@include('partials._images', ['item' => $article, 'profile' => 'sm-card'])</a>
  </div>

  <div class="col-md-6 position-static pl-md-0 d-flex flex-column">
    <div class="card-body py-md-0">
      <h5 class="card-title mt-0"><a href="{{ $article->path() }}" class="text-decoration-none">{{ $article->title }}</a></h5>
      <p class="card-text">{{ $article->present()->excerpt }}</p>
    </div>

    <div class="card-footer">
      <slot name="notes"></slot>
    </div>

  </div>

</div>