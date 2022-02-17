<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Parser;
use App\Http\Controllers\Controller;
use App\Jobs\NewsParsingJob;
use App\Models\News;
use Illuminate\Http\Request;

class ParserController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Parser $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $links = [
            'https://news.yandex.ru/auto.rss',
            'https://news.yandex.ru/auto_racing.rss',

        ];
        foreach ($links as $link){
            dispatch(new NewsParsingJob($link));
        }
        echo "parse done";
    }
}
