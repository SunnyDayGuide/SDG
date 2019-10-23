<?php

namespace App\Presenters;

use Illuminate\Support\Str;
use Laracasts\Presenter\Presenter;


class ArticlePresenter extends Presenter
{
	public function excerpt()
	{
		return Str::limit($this->entity->excerpt, 125, '...');
	}	

	public function date()
	{
		$published = $this->entity->published_at;
		$updated = $this->entity->updated_at;

		if ($published->greaterThanOrEqualTo($updated)) {
			return '<time class="article-date published" datetime="' . $published. '"> Published ' . $published->format('F j, Y') . '</time>';
		} else return '<time class="article-date published" datetime="' . $updated. '"> Updated ' . $updated->format('F j, Y') . '</time>';
	}

	public function published_at()
	{
		return '<time class="article-date published">' . $this->entity->published_at->format('F j, Y') . '</time>';
	}

	public function publishedDiff()
	{
		return '<time class="meta-time">' . $this->entity->published_at->diffForHumans() . '</time>';
	}
}