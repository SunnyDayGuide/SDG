<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateArticlesTest extends TestCase
{
	use RefreshDatabase;

	public function setUp()
    {
        parent::setUp();
        $this->withExceptionHandling();
    }

    /** @test */
    public function an_article_can_be_updated()
    {
        $this->signIn();

        $market = 'App\Market'::first();
        $article = create('App\Article', ['market_id' => $market->id]);

        $this->patch(
        	route('admin.articles.update', [
        		'market' => $market->slug, 
        		'article' => $article->id
        	]),
        	$updatedArticle = [
        		'title' => 'altered title',
	            'author' => 'altered author',
	            'content' => 'altered content',
	            'featured' => true,
	            'archived' => false,
	            'market_id' => $market->id,
	            'article_type_id' => $article->article_type_id
        	]
        );

        $this->get(route('admin.articles.index', ['market' => $market->slug]))
        	->assertSee($updatedArticle['title']);
    }

    /** @test */
    public function an_article_can_be_archived()
    {
    	$this->signIn();

        $market = 'App\Market'::first();
        $article = create('App\Article', ['market_id' => $market->id]);

        $this->assertFalse($article->archived);

        $this->patch(
        	route('admin.articles.update', [
        		'market' => $market->slug, 
        		'article' => $article->id,
        	]),
        	[
        		'title' => 'altered title',
	            'author' => 'altered author',
	            'content' => 'altered content',
	            'featured' => true,
	            'archived' => true,
	            'market_id' => $market->id,
	            'article_type_id' => $article->article_type_id
        	]
        );

        $this->assertTrue($article->fresh()->archived);
    }

        /** @test */
    public function an_administrator_can_edit_an_archived_article()
    {
        $this->signIn();
        $market = 'App\Market'::first();
        $article = create(\App\Article::class, ['archived' => true]);

        $this->assertTrue($article->archived);

        $this->get(route('admin.articles.edit', ['market' => $market->slug, $article->id]))
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function an_administrator_can_activate_an_archived_article()
    {
        $this->signIn();

        $market = 'App\Market'::first();
        $article = create(\App\Article::class, ['archived' => true]);

        $this->assertTrue($article->archived);

        $this->patch(
            route('admin.articles.update', [
                'market' => $market->slug, 
                'article' => $article->id,
            ]),
            [
                'title' => 'altered title',
                'author' => 'altered author',
                'content' => 'altered content',
                'featured' => true,
                'archived' => false,
                'market_id' => $market->id,
                'article_type_id' => $article->article_type_id
            ]
        );

        $this->assertFalse($article->fresh()->archived);
    }

}
