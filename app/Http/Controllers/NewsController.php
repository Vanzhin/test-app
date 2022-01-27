<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = new News();
        return view('news.index', [
            'newsList' => $news->getAllNews(),
        ]);
    }

    public function show(int $id)
    {

        $news = new News();
        return view('news.show', [
            'news' => $news->getOneNews($id),
        ]);
    }

    public function showByCat(int $id)
    {
        return view('news/news_by_cat', [
            'newsList' => $this->getNewsByCat($id),
            'category_id' => $id
        ]);
    }

}
