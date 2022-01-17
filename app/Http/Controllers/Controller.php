<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index()
    {
        return view('index', [
            'menu' => $this->getMenu(),
        ]);
    }

    public function getNews(?int $id = null): array
    {
        $faker = Factory::create();
        $newsNumber = 30;
        $data = [];
        if (is_null($id)){
            for ($i = 1; $i <= $newsNumber; $i++){
                $data[] = [
                    'id' => $i,
                    'title' => $faker->jobTitle,
                    'description' => $faker->text(100),
                    'author' => $faker->userName(),
                    'category_id' => $faker->numberBetween(1,5),
                    'created_at' => now('Asia/Yekaterinburg'),


                ];
            }

        } else{
            $data = [
                    'id' => $id,
                    'title' => $faker->jobTitle,
                    'description' => $faker->text(300),
                    'author' => $faker->userName(),
                    'created_at' => now('Asia/Yekaterinburg'),
            ];
        }


        return $data;
    }

    public function getCategories(?int $id = null): array
    {
        $faker = Factory::create();
        $categoryNumber = 5;
        $data = [];
        if (is_null($id)){
            for ($i = 1; $i <= $categoryNumber; $i++){
                $data[] = [
                    'id' => $i,
                    'title' => $faker->jobTitle,
                    'created_at' => now('Asia/Yekaterinburg'),

                ];
            }

        } else{
            $data = [
                'id' => $id,
                'title' => $faker->jobTitle,
            ];
        }


        return $data;
    }

    public function getMenu(): array
    {
        return $menu = [
            'Главная' => '/',
            'Новости' => '/news',
            'Категории' => '/categories',
            'Войти/Зарегистрироваться' => '/admin'



        ];
    }
    public function getNewsByCat(int $category_id = null): array
    {
        $news = $this->getNews();
        foreach ($news as $item){
            if ($category_id === $item['category_id'])
            $data[] = $item;
        }



        return $data;
    }
}
