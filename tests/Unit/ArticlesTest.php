<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlesTest extends TestCase
{
	use RefreshDatabase;
	
	/** @test */
    public function an_article_has_a_path()
    {
        $article = create('App\Article');
        dd($article);
    }
}
