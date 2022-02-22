<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::query()
            ->select('id','title', 'description')
        ->paginate(6);
        return view('categories.index', [
            'categoryList' => $category,
        ]);
    }

}
