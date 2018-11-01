<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

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

        Storage::fake('public');

        $market = 'App\Market'::find(1);

        $article = make('App\Article', [
            'market_id' => $market->id, 
            'image' => $file = UploadedFile::fake()->image('article.jpg')
        ]);

        $this->post("admin/{$market->slug}/articles", $article->toArray());
        
        $this->get($article->path())
            ->assertSee($article->title)
            ->assertSee($article->market->name)
            ->assertSee('article.jpg');
    }

    /** @test */
    function an_article_requires_a_title()
    {
        $this->publishArticle(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    function an_article_requires_an_author()
    {
        $this->publishArticle(['author' => null])
            ->assertSessionHasErrors('author');
    }

    /** @test */
    function an_article_requires_content()
    {
        $this->publishArticle(['content' => null])
            ->assertSessionHasErrors('content');
    }

    /** @test */
    function an_article_requires_an_article_type()
    {
        $this->publishArticle(['article_type_id' => null])
            ->assertSessionHasErrors('article_type_id');
    }

     /** @test */
    function authorized_users_can_delete_articles()
    {
        $this->signIn();

        Storage::fake('public');

        $market = 'App\Market'::find(1);

        $article = create('App\Article', [
            'market_id' => $market->id, 
            'image' => $file = UploadedFile::fake()->image('article.jpg')
        ]);

        $response = $this->json('DELETE', "admin/{$market->slug}/articles/$article->id");

        // $response->assertStatus(302)->assertRedirect(route('login'));

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);

        Storage::disk('public')
            ->assertMissing('images/'.$market->slug.'/articles/' . $market->code.'-'.'article.jpg');
    }

    protected function publishArticle($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $market = 'App\Market'::find(1);

        $article = make(\App\Article::class, $overrides);

        return $this->post("admin/{$market->slug}/articles", $article->toArray());
    }

}
