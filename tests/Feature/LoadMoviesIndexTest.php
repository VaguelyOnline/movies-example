<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoadMoviesIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_movies_index_page_can_be_loaded()
    {
        $response = $this->get('/movies');

        $response->assertStatus(200);
    }
}
