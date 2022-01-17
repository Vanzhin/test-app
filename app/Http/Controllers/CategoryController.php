<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('news/categories', [
            'categoryList' => $this->getCategories(),
        ]);
    }

}
