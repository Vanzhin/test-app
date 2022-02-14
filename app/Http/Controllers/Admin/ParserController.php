<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Parser;
use App\Http\Controllers\Controller;
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
    public function __invoke(Request $request, Parser $service)
    {
        $links = [
            'https://news.yandex.ru/music.rss',
            'https://news.yandex.ru/business.rss',
        ];
        $parseDone = $service->saveToDb($links);

        if ($parseDone){
            return redirect()->route('admin.news')->with('success', __('messages.admin.news.parsed.success'));

        }else{
            return redirect()->route('admin.news')->with('error', __('messages.admin.news.parsed.error'));

        }
    }
}
