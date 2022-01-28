<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('categories')->insert($this->getData());
    }

    private function getData()
    {
        $faker = Factory::create();
        $categoryNumber = 10;
        $data = [];

            for ($i = 1; $i <= $categoryNumber; $i++){
                $data[] = [
                    'title' => $faker->jobTitle,
                    'description' => $faker->text(100),


                ];
            }
        return $data;
        }

}
