<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert([
            ['url' => 'https://news.yandex.ru/auto.rss'],
            ['url' => 'https://news.yandex.ru/auto_racing.rss'],
            ['url' => 'https://news.yandex.ru/army.rss'],
        ]);

    }
}
