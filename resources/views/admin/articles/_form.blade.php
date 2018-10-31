<div class="row">
	<div class="col-md-8">
		<div class="form-group">
			<label for="name">Title</label>
			<input type="text" class="form-control" id="title" name="title"
			value="{{ old('title', $article->title) }}" required>
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
			<label for="image">Featured Image</label>
			<input type="file" class="form-control-file" id="image" name="image" value="{{ old('image', $article->image) }}">
		</div>

		@isset($article->image)
		<div class="form-group">
			<img src="{{ asset($article->image) }}" alt="" width="50%">
		</div>
		@endisset
	</div>  <!-- end of big col -->

	<div class="col-md-3 bg-white">

		<div class="card bg-light mb-4">
			<h5 class="card-header">Publish</h5>
			<div class="card-body">

				<div class="form-group">
					<label for="archived">Status</label>
					<select name="archived" id="archived" class="form-control">
						<option value="0" {{ old('archived', $article->archived) ? '' : 'selected' }}>Active</option>
						<option value="1" {{ old('archived', $article->archived) ? 'selected' : '' }}>Archived</option>
					</select>
				</div>

				@isset($article->published_at)
				<div class="form-group">
					<p>
						<i class="fas fa-calendar-alt"></i> Published on: <strong>{{ $article->published_at->format('n/d/Y @ g:ia') }}</strong>
					</p>
				</div>
				@endisset

			</div>

			<div class="card-footer d-flex justify-content-between">
				<a href="{{ route('admin.articles.index', $market->slug) }}" class="btn btn-secondary">Cancel</a>
				<button type="submit" class="btn btn-primary">{{ $buttonText ?? 'Add Article' }}</button>
			</div>
		</div>

		<div class="card mb-4">
			<h5 class="card-header">Properties</h5>
			<div class="card-body">
				<div class="form-group">
					<label for="article_type_id">Article Type</label>
					<select class="form-control" name="article_type_id">
						<option value="">Select Type</option>
						@foreach($articleTypes as $articleType)
						<option value="{{ $articleType->id }}" {{ $article->article_type_id == $articleType->id ? 'selected' : '' }}>{{ $articleType->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<div class="form-check">
						<input type="hidden" name="featured" value="0" />
						<input class="form-check-input" type="checkbox" name="featured" value="1" {{ old('featured', $article->featured) ? 'checked="checked"' : '' }}>
						<label class="form-check-label" for="featured">
							Featured Article
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="card mb-4">
			<h5 class="card-header">Categories</h5>
			<div class="card-body">
				@foreach($market->categories->sortBy('name') as $category)
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="categories[]" value="{{$category->id}}" {{ $article->categories->contains($category->id) ? 'checked' : '' }}> 
					<label class="form-check-label" for="{{ $category->id }}">
						{{ $category->name }}
					</label>
				</div>
				@endforeach
			</div>
		</div>

		<div class="card mb-4">
			<h5 class="card-header">Tags</h5>
			<div class="card-body">
				<h5 class="card-title">Enter some tags here</h5>
				<p class="card-text">This will be the tag box</p>
				<a href="#" class="card-link">Add Tags</a>
			</div>
		</div>

	</div>  <!-- end of small col -->

</div> <!-- end of row -->