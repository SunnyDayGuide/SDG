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

        $this->get(route('admin.articles.create', $market))
            ->assertRedirect(route('login'));

        $this->post(route('admin.articles.store', $market))
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

        $this->post(route('admin.articles.store', $market), $article->toArray());
        
        $this->get($article->path())
            ->assertSee($article->title)
            ->assertSee($article->market->name)
            ->assertSee('article.jpg');
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

        $response = $this->json('DELETE', route('admin.articles.destroy', [$market->slug, $article->id]));

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
