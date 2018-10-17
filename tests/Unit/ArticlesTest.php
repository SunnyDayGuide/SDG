<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlesTest extends TestCase
{
	use RefreshDatabase;

	public function setUp()
    {
        parent::setUp();
        $this->article = create('App\Article');

    }

    /** @test */
    public function it_belongs_to_a_market()
    {
    	$this->assertInstanceOf('App\Market', $this->article->market);
    }

    /** @test */
    public function it_has_a_type()
    {
    	$this->assertInstanceOf('App\ArticleType', $this->article->articleType);
    }

    /** @test */
    function an_article_has_a_path()
    {
        $this->assertEquals(
            "/{$this->article->market->slug}/articles/{$this->article->slug}", $this->article->path()
        );
    }
}
