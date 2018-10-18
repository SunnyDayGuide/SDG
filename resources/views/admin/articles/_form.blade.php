<div class="form-group">
	<label for="categories">Categories</label>
	@foreach($market->categories->sortBy('name') as $category)
		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="categories[]" 
				value="{{ $category->id }}" {{ ( is_array(old('categories')) && in_array($category->id, old('categories')) ) ? 'checked ' : '' }}>
			<label class="form-check-label" for="{{ $category->id }}">
			{{ $category->name }}
			</label>
		</div>
	@endforeach
</div>

{{-- <div class="form-group">
	<label for="categories">Categories</label>
	@foreach($categories->sortBy('name') as $category)
		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="categories[]" 
				value="{{ $category->id }}" {{ $market->hasCategory($category->id) ? "checked" : "" }}>
			<label class="form-check-label" for="{{ $category->id }}">
			{{ $category->name }}
			</label>
		</div>
	@endforeach
</div> --}}

<div class="form-group">
		<div class="form-check">
			<input type="hidden" name="featured" value="0" />
			<input class="form-check-input" type="checkbox" name="featured" value="1" {{ ( is_array(old('featured')) && in_array($article->featured, old('featured')) ) ? 'checked ' : '' }}>
			<label class="form-check-label" for="featured">
			Featured Article
			</label>
		</div>
</div>

<div class="form-group">
	<label for="name">Title</label>
        <input type="text" class="form-control" id="title" name="title"
           value="{{ old('title', $article->title) }}" required>
</div>

<div class="form-group">
	<label for="article_type_id">Article Type</label>
	<select class="form-control" name="market_id">
		<option selected>Select Type</option>
		@foreach($articleTypes as $type)
			<option value="{{ $type->id }}" {{ $article->articleType->id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
		@endforeach
	</select>
</div>	

<div class="form-group">
	<label for="author">Author</label>
    <input type="text" class="form-control" id="author" name="author"
           value="{{ old('author', $article->author) }}">
</div>
	
<div class="form-group">
	<label for="content">Content</label>
    <textarea class="form-control" rows="8" id="content" name="content" value="{{ old('content', $article->content) }}">{{ old('content', $article->content) }}</textarea>
</div>

<div class="form-group">
	<label for="content">Excerpt</label>
    <textarea class="form-control" rows="2" id="excerpt" name="excerpt" value="{{ old('excerpt', $article->excerpt) }}">{{ old('excerpt', $article->excerpt) }}</textarea>
</div>

<div class="form-group">
	<label for="image">Image Placeholder</label>
    <input type="text" class="form-control" id="image" name="image"
           value="{{ old('image', $article->image) }}">
</div>

<div class="form-group">
	<button type="submit" class="btn btn-success btn-lg btn-block">Add Article</button>
</div>

@if (Session::has('success'))
	<div class="alert alert-success" role="alert">
		<strong>Success:</strong> {{ Session::get('success') }}
	</div>
@endif

@if (count($errors))
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif