<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(5);

        return view('admin.news.index', [
        'newsList' => $news,
        'fields' => News::getAllFields('news'),
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//TODO не создавать модель
        $news = new News();

        return view('admin.news.create', [
            'newsFields' => $news->getFieldsToCreate(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
        //TODO сократить путь до картинки в БД
        $image = null;
        if($request->file('image')){
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $image);

        };

        $request->validate([
            'title'=>[
            'min:5',
            'required',
            'string'
            ],
            'categories'=>[
                'required'
            ]
            ]);
        $data = $request->only('title', 'author', 'status', 'description') +
            ['slug' => Str::slug($request->input('title'))] +
              ['image' => $image];

        $created = News::create($data);
        if($created){
            foreach($request->input('categories') as $category){
                DB::table('news_categories')->insert([
                    'news_id' =>$created->id,
                    'category_id' => intval($category),
                ]);

            }
            return redirect()->route('admin.news')->with('success', 'Запись добавлена');
        }
        return back()->with('error', 'Ошибка добавления записи')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        $newsCategories = DB::table('news_categories')
            ->where('news_id', '=', $news->id)
            ->get()
            ->map(fn($item) => $item->category_id)
            ->toArray();
        return view('admin.news.edit', [
            'newsFields' => $news->getFieldsToCreate(),
            'news' => $news,
            'categories' => $categories,
            'newsCategories' => $newsCategories,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title'=>[
                'min:5',
                'required',
                'string'
            ],
            'categories'=>[
                'required'
            ]
        ]);
        $data = $request->only('title', 'author', 'status', 'description', 'image') +
            ['slug' => Str::slug($request->input('title'))];
        $updated = $news->fill($data)->save();
        if($updated){
            DB::table('news_categories')
                ->where('news_id', '=', $news->id)
                ->delete();
            foreach($request->input('categories') as $category){
                DB::table('news_categories')->insert([
                    'news_id' =>$news->id,
                    'category_id' => intval($category),
                ]);

            }
            return redirect()->route('admin.news')->with('success', 'Запись обновлена');
        }
        return back()->with('error', 'Ошибка обновления записи')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
