<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Parser;
use App\Http\Controllers\Controller;
use App\Jobs\NewsParsingJob;
use App\Models\News;
use App\Models\Resource;
use Illuminate\Http\Request;

class ParserController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $links = Resource::all()->toArray();
//        $links = [
//            'https://news.yandex.ru/auto.rss',
//            'https://news.yandex.ru/auto_racing.rss',
//
//        ];
        foreach ($links as $link){
            if ($link['is_active']){
               dispatch(new NewsParsingJob($link['url']));
            }

        }
        echo "parse done";
    }
}
