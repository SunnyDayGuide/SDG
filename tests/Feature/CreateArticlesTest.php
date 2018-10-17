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

        $this->get('admin/articles/create')
            ->assertRedirect(route('login'));

        $this->post(route('admin.articles.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */ 
    public function a_user_can_create_new_articles()
    {
        $this->signIn();
        $article = factory('App\Article')->make();

        $this->post('admin/articles', $article->toArray());

        $this->get($article->path())
            ->assertSee($article->title);
    }

}
