<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()->select(News::$columnsToGet)->paginate(6);
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

    public function indexByCat(int $id)
    {

        $category = Category::find($id);
        $news = Category::find($id)->news()->get();
        return view('news/news_by_cat', [
            'newsList' => $news,
            'category' => $category
        ]);
    }

}
