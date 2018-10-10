<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlesTest extends TestCase
{
	use RefreshDatabase;
	
	/** @test */
    public function a_visitor_can_browse_articles()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
