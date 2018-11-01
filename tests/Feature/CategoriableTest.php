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
    public function an_article_can_be_assigned_categories()
    {
        $category1 = Category::find(1);
        $category2 = Category::find(2);
        $article = create('App\Article');

        $article->assignCategories([$category1->id, $category2->id]);

        $this->assertCount(2, $article->categories);
        $this->assertTrue($article->categories->contains('id', $category1->id));
    }

    /** @test  */
    public function when_an_article_is_deleted_the_associated_categories_are_detached()
    {
        $category1 = Category::find(1);
        $category2 = Category::find(2);
        $article = create('App\Article');

        $article->assignCategories([$category1->id, $category2->id]);

        $this->assertCount(2, $article->categories);

        $article->delete();

        
        
    }
}
