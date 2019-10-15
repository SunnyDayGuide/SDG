<div class="search py-3 py-md-5">
	<div class="mx-auto text-center">
		<form method="GET" action="{{ route('articles.search', $market->slug) }}">
			<div class="form-row">
				<div class="form-group col-md-5">
				  <select id="category" name="category" class="form-control">
			        <option value>Category Search</option>
			        @foreach($searchCategories as $searchCategory)
					<option value="{{ $searchCategory->id }}">{{ $searchCategory->name }}</option>
					@foreach ($searchCategory->searchSubcategories->sortBy('name') as $subcategory)
					<option value="{{ $subcategory->id }}" class="ml-1">-- {{ $subcategory->name }}</option>
					@endforeach
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