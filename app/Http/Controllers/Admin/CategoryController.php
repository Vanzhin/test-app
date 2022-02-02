<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::paginate(5);
        return view('admin.categories.index', [
            'categoryList' => $categories,
            'fields' =>Category::getAllFields('categories')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::$columnsToGet;
        return view('admin.categories.create', [
            'categoryFields' => $category,
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
        $request->validate([
            'title'=>[
                'min:5',
                'required',
                'string'
            ],
            'description'=>[
                'required',
                'min:20',
                'max:200'
            ]
        ]);

        $data = $request->only('title', 'description');
        $created = Category::create($data);
        if($created){

            return redirect()->route('admin.categories')->with('success', 'Запись добавлена');
        }
        return back()->with('error', 'Ошибка добавления записи')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('admin.categories.edit', [
            'categoryFields' => $category::$columnsToGet,
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title'=>[
                'min:5',
                'required',
                'string'
            ],
            'description'=>[
                'required',
                'min:20',
                'max:200'
            ]
        ]);
        $updated = $category->fill($request->only('title', 'description'))->save();

        if($updated){
            return redirect()->route('admin.categories')->with('success', 'Запись обновлена');
        }
        return back()->with('error', 'Ошибка обновления записи')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
