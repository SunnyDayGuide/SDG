@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2 mr-4">Articles</h1>
<a class="btn btn-primary" href="{{ route('admin.articles.create', $market->slug) }}" role="button">New Article</a>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12 table-responsive">
		<p><i class="fas fa-star text-success"></i> = Featured</p>
		<table class="table">
			<thead class="thead-light">
				<th></th>
				<th>Title</th>
				<th>Type</th>
				<th width="15%">Categories</th>
				<th width="15%">Tags</th>
				<th width="15%">Date</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach ($articles as $article)
				<tr>
					<td>
						@if($article->featured == true)
						<i class="fas fa-star text-success"></i>
						@endif
					</td>
					<td>
						<strong><a href="{{ route('admin.articles.edit', [$market->slug, $article->id]) }}">{{ $article->title }}</a>
						@if($article->archived == true)
						<span>— Archived</span>
						@endif
					</strong>
					</td>
					<td>{{ $article->articleType->name }}</td>
					<td>
						@if ($article->categories->count())
							@foreach ($article->categories as $category)
							{{ $category->name }}{{ $loop->last ? '' : ', ' }}
							@endforeach
						@endif
					</td>
					<td>
						@if ($article->tagged->count())
							@foreach ($article->tagged as $tag)
							{{ $tag->tag_name }}{{ $loop->last ? '' : ', ' }}
							@endforeach
						@endif
					</td>
					<td>Published <br>
						{{ $article->published_at->format('n-d-Y') }}
					</td>
					<td>
						<form action="{{ route('admin.articles.destroy', [$market->slug, $article->id]) }}" method="POST">
							@method('DELETE')
						    @csrf
						    <button type="submit" class="btn btn-danger" value="Delete"><i class="far fa-trash-alt"></i></button>
						</form>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

		{{ $articles->links() }}

	</div>
	<div class="col">

	</div>

</div> <!-- end of row -->

@endsection