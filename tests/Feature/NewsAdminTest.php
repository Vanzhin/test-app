<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsAdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNewsIndex()
    {
        $response = $this->get(route('admin.news'));

        $response->assertStatus(200);
    }

    public function testNewsCreate()
    {
        $response = $this->get(route('admin.news.create'));

        $response->assertStatus(200);
        $data = [
            'news'
        ];

        $response->assertViewHasAll($data);

        $response->assertViewIs('admin.news.create');
    }



    public function testNewsStore()
    {
        $faker = Factory::create();
        $data = [
            'title' => 'hello',
            'description' => $faker->text(50),
            'author' =>$faker->name(),
            'full_description' => $faker->sentence


        ];
        $response = $this->post(route('admin.news.store'), $data);
        $response->assertJson($data);
    }
}
