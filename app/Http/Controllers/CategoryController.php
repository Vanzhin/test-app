<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = new Category();
        return view('categories.index', [
            'categoryList' => $category->getAllCategories(),
        ]);
    }

}
