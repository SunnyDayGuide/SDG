<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateArticlesTest extends TestCase
{
	use RefreshDatabase;

	public function setUp()
    {
        parent::setUp();
    }

	/** @test */
    public function guests_may_not_create_articles()
    {
        $this->withExceptionHandling();

        $market = 'App\Market'::find(1);

        $this->get("admin/{$market->slug}/articles/create")
            ->assertRedirect(route('login'));

        $this->post("admin/{$market->slug}/articles")
            ->assertRedirect(route('login'));
    }

    /** @test */ 
    public function a_user_can_create_new_articles()
    {
        $this->signIn();

        $market = 'App\Market'::find(1);
        $article = make('App\Article', ['market_id' => $market->id]);

        $this->post("admin/{$market->slug}/articles", $article->toArray());
        
        $this->get($article->path())
            ->assertSee($article->title)
            ->assertSee($article->market->name);
    }

}
