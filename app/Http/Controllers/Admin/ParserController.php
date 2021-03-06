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

        foreach ($links as $link){
            if ($link['is_active']){
               dispatch(new NewsParsingJob($link['url']));
            }
        }

        return redirect()->route('admin.news')->with('success', __('messages.admin.news.parsed.success',));
    }
}
