@extends('layouts.admin')

@section('content')

<div class="container">
	<div class="row">
		<div class="col">
			<h1>All {{ $market->name }} Articles</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
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
{{-- 								<div class="d-inline-block">
									<form action="{{ route('admin.markets.destroy', $market->id) }}" method="POST">
										@method('DELETE')
									    @csrf
									    <input type="submit" class="btn btn-sm btn-secondary" value="Delete">
									</form>
								</div> --}}
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>

	</div> <!-- end of row -->
</div>

@endsection