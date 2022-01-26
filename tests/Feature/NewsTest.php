<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNewsIndex()
    {
        $response = $this->get('/news');

        $response->assertStatus(200);
    }

    public function testNewsView()
    {
        $response = $this->get('/news');
        $data = [
            'newsList'
        ];

        $response->assertViewHasAll($data);

        $response->assertViewIs('news.index');
    }

}
