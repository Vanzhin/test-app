<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news/index', [
            'newsList' => $this->getNews(),
        ]);
    }

    public function show(int $id)
    {
        return view('news/show', [
            'news' => $this->getNews($id),
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
