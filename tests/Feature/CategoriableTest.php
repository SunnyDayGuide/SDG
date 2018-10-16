<?php

namespace Tests\Feature;

use App\Article;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriableTest extends TestCase
{
	use RefreshDatabase;

    /** @test  */
    public function an_article_can_be_assigned_a_category()
    {
        $category = Category::find(1);
        $article = factory(Article::class)->create();

        $article->assignCategory($category);

        $this->assertCount(1, $article->categories);
        $this->assertTrue($article->categories->contains('id', $category->id));
    }
}
