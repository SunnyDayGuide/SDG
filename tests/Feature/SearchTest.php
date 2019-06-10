<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->article = create('App\Article');
    }

    /** @test */
    public function a_user_can_search_articles()
    {
        $this->signIn();

        config(['scout.driver' => 'algolia']);
        $search = 'foobar';

        create('App\Article', ['market_id' => 1], 2);
        create('App\Article', ['market_id' => 1, 'content' => "An article with the {$search} term"], 2);

        do {
            sleep(1);
            $results = $this->getJson("destinations/branson/articles/search?q={$search}")->json();
        } while (empty($results));

        $this->assertCount(2, $results);

        Article::latest()->take(4)->unsearchable();
    }
}
