<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\Category;
use App\Models\News;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

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
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = app(UploadService::class)
                ->saveImage($request->file('image'), 'news');
        };

        $created = News::create($data);
        //slug генерируется за счет трейта Sluggable в модели News
        if($created){
//            foreach($request->input('categories') as $category){
//                DB::table('news_categories')->insert([
//                    'news_id' =>$created->id,
//                    'category_id' => intval($category),
//                ]);
//
//            }
            $created->categories()->attach($request->input('categories'));
            return redirect()->route('admin.news')->with('success', __('messages.admin.news.created.success'));
        }
        return back()->with('error', __('messages.admin.news.created.error'))->withInput();
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
     * @param UpdateRequest $request
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, News $news)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = app(UploadService::class)
                ->saveImage($request->file('image'), 'news');

            // если сохранился файл, то старый удаляю
            if ($data['image']){
            app(UploadService::class)->deleteImage($news->image);
            }
        };

        $news->slug = null;
        $updated = $news->fill($data)->save();
        if($updated){
//            DB::table('news_categories')
//                ->where('news_id', '=', $news->id)
//                ->delete();
//            foreach($request->input('categories') as $category){
//                DB::table('news_categories')->insert([
//                    'news_id' =>$news->id,
//                    'category_id' => intval($category),
//                ]);
//            }

            $news->categories()->detach();
            $news->categories()->attach($request->input('categories'));



            return redirect()->route('admin.news')->with('success', __('messages.admin.news.updated.success'));
        }
        return back()->with('error',__('messages.admin.news.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $deleted = $news->delete();
        if($deleted){
            app(UploadService::class)->deleteImage($news->image);
            return redirect()->route('admin.news')->with('success', __('messages.admin.news.deleted.success'));
        }
        return back()->with('error', __('messages.admin.news.deleted.error'))->withInput();
    }
}
