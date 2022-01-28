<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_categories')->insert($this->getData());

    }
    private function getData()
    {
        $faker = Factory::create();
        $rowsNumber = 20;
        $newsNumber = 20;
        $categoryNumber = 10;
        $data = [];

        for ($i = 1; $i <= $rowsNumber; $i++){
            $data[] = [
                'news_id' => $faker->numberBetween(1,$newsNumber),
                'category_id' => $faker->numberBetween(1,$categoryNumber),

            ];
        }
        return $data;
    }

}
