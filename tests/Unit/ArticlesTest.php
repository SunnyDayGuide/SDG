<?php

namespace Tests\Feature;

use App\Article;
use App\Market;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
	use RefreshDatabase;

	public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_belongs_to_a_market()
    {
        $this->article = create('App\Article');
    	$this->assertInstanceOf('App\Market', $this->article->market);
    }

    /** @test */
    public function it_has_a_type()
    {
        $this->article = create('App\Article');
    	$this->assertInstanceOf('App\ArticleType', $this->article->articleType);
    }

    /** @test */
    function an_article_has_a_path()
    {
        $this->article = create('App\Article');
        $this->assertEquals(
            "/destinations/{$this->article->market->slug}/articles/{$this->article->slug}", $this->article->path()
        );
    }

    /** @test */
    public function an_article_can_be_archived()
    {
        $article = create('App\Article');
        $this->assertFalse($article->archived);

        $article->archive();
        $this->assertTrue($article->archived);
    }    
    /** @test */
    public function archived_articles_are_excluded_by_default()
    {
        $article1 = create(Article::class, ['market_id' => 1]);
        $article2 = create(Article::class, ['market_id' => 1, 'archived' => true]);

        $this->assertEquals(1, Article::count());
    }
}
