<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;


class CategoriesAdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoriesIndex()
    {
        $response = $this->get(route('admin.categories'));

        $response->assertStatus(200);
    }

    public function testCategoriesCreate()
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertStatus(200);
        $data = [
            'categoryList'
        ];

        $response->assertViewHasAll($data);

        $response->assertViewIs('admin.categories.create');
    }

    public function testCategoriesStore()
    {
        $faker = Factory::create();
        $data = [
            'title' => $faker->sentence(1)


        ];
        $response = $this->post(route('admin.categories.store'), $data);

        $response->assertJson($data);
    }
}
