<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('news')->insert($this->getData());

    }
    private function getData()
    {
        $faker = Factory::create();
        $newsNumber = 20;
        $data = [];

        for ($i = 1; $i <= $newsNumber; $i++){
            $title = $faker->sentence(5);
            $data[] = [
                'title' => $title,
                'slug' => Str::slug($title),
                'author' => $faker->firstName() . " " . $faker->lastName(),
                'description' => $faker->sentence(),


            ];
        }
        return $data;
    }
}
