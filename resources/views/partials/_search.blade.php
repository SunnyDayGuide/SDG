<div class="search p-3 p-md-5">
	<h2 class="mb-3 text-center">Search {{ $page->title }}</h2>
	<div class="container mx-auto text-center">
		<form method="GET" action="{{ route('articles.search', $market->slug) }}">
			<div class="form-row">
				<div class="form-group col-md-5">
				  <select id="category" name="category" class="form-control">
			        <option value>Category Search</option>
			        @foreach($market->categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
			      </select>
				</div>
				<div class="form-group col-md-5">
				  <input type="text" class="form-control" id="keyword" name="q" placeholder="Search for something...">
				</div>
				<div class="form-group col-md-2"><button type="submit" class="btn btn-primary btn-block">Search</button></div>
				</div>
		</form>
	</div>
</div>