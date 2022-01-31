<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()->select(News::$columnsToGet)->paginate(3);
        return view('news.index', [
            'newsList' => $news,
        ]);
    }

    public function show(News $news) :object
    {
        return view('news.show', [
            'news' => $news,
        ]);
    }

    public function showByCat(int $id)
    {
        $news = new News();

        return view('news/news_by_cat', [
            'newsList' => $news->getNewsByCategory($id),
            'category_id' => $id
        ]);
    }

}
