<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbacksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedbacks')->insert($this->getData());

    }

    private function getData()
    {
        $faker = Factory::create();
        $feedbackNumber = 10;
        $data = [];

        for ($i = 1; $i <= $feedbackNumber; $i++){
            $data[] = [
                'nickName' => $faker->firstName . ' ' . $faker->lastName,
                'message' => $faker->text(200),


            ];
        }
        return $data;
    }

}
