<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadArticlesTest extends TestCase
{
	use RefreshDatabase;

	public function setUp(): void
    {
        parent::setUp();
        $this->article = create('App\Article');
    }

    /** @test */
    public function a_visitor_can_view_trip_ideas()
    {
        $article = factory('App\Article')->states('tripIdea')->create();
        $market = $article->market;

        $this->get(route('articles', $market))
			->assertSee($article->title);
    }

    /** @test */
    public function a_visitor_can_view_visitor_info()
    {
        $article = factory('App\Article')->states('visitorInfo')->create();
        $market = $article->market;

        $this->get(route('articles', $market))
            ->assertSee($article->title);
    }

    /** @test */
    public function a_visitor_can_view_advertiser_spotlights()
    {
        $article = factory('App\Article')->states('advSpotlight')->create();
        $market = $article->market;

        $this->get(route('articles', $market))
            ->assertSee($article->title);
    }

    /** @test */
    public function a_visitor_can_view_a_single_article()
    {
        $market = $this->article->market;

        $this->get($this->article->path())
			->assertSee($this->article->title);
    }

}
