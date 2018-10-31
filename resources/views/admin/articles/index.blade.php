@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2 mr-4">Articles</h1>
<a class="btn btn-primary" href="{{ route('admin.articles.create', $market->slug) }}" role="button">New Article</a>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12 table-responsive">
		<table class="table">
			<thead class="thead-light">
				<th>Title</th>
				<th>Type</th>
				<th width="15%">Categories</th>
				<th width="15%">Tags</th>
				<th width="10%">Date</th>
				<th width="1em">Featured</th>
			</thead>
			<tbody>
				@foreach ($articles as $article)
				<tr class="{{ $article->archived ? 'table-light' : '' }}">
					<td><strong><a href="{{ route('admin.articles.edit', [$market->slug, $article->id]) }}" class="{{ $article->archived ? 'alert-link' : '' }}">{{ $article->title }}</a></strong>
						<form action="{{ route('admin.articles.destroy', [$market->slug, $article->id]) }}" method="POST">
							@method('DELETE')
						    @csrf
						    <input type="submit" class="btn btn-sm btn-secondary" value="Delete">
						</form>
					</td>
					<td>{{ $article->articleType->name }}</td>
					<td>
						@if ($article->categories->count())
							@foreach ($article->categories as $category)
							{{ $category->name }}{{ $loop->last ? '' : ', ' }}
							@endforeach
						@endif
					</td>
					<td>Tag 1, Tag 2</td>
					<td>Published <br>
						{{ $article->published_at->format('n-d-Y') }}
					</td>
					<td>{{ $article->featured }}</td>
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