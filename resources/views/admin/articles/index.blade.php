@extends('layouts.admin')
@section('pageHeader')
<h1 class="h2">{{ $market->name }} - All Articles</h1>
@endsection

@section('content')

	<div class="row">
		<div class="col-md-9 table-responsive">
			<table class="table">
				<thead class="thead-light">
					<th>#</th>
					<th>Name</th>
					<th>Type</th>
					<th>Featured</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($articles as $article)
						<tr>
							<td>{{ $article->id }}</td>
							<td>{{ $article->title }}</td>
							<td>{{ $article->articleType->name }}</td>
							<td>{{ $article->featured }}</td>
							<td align="right">
 								<a href="{{ route('admin.articles.edit', [$market->slug, $article->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
		<div class="col">
			<a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.articles.create', $market->slug) }}" role="button">Create Article</a>
		</div>

	</div> <!-- end of row -->

@endsection