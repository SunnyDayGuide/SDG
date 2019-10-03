<div class="media border-bottom border-light mb-3 pb-3 overlay position-relative">
  
  <div class="image mr-3">
    @include('partials._images', ['item' => $article, 'profile' => 'sm-card'])
  </div>

  <div class="media-body">
    @if ($article->subcategories->count())
    @include('categories._links', ['item' => $article])
    @endif
    
    <a href="{{ $article->path() }}" class="stretched-link text-reset text-decoration-none">
      <h5>{{ $article->title }}</h5>
    </a>
    <p>{{ $article->blurb }}</p>

    @if ($article->tags->count())
    <div class="media-footer">
      @foreach($article->tags as $tag)
      <a href="{{ $market->path().'/tags/'.$tag->slug }}" class="btn btn-sm btn-light text-white mr-2 tags">{{ $tag->name }}</a>
      @endforeach
    </div>
    @endif
  </div>

</div>