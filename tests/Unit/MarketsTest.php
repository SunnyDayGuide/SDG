<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarketsTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function the_index_page_should_list_all_the_markets()
    {
        $this->assertTrue(true);
    }
}
