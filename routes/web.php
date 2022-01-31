<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\{NewsController, Controller, CategoryController, AuthController, FeedbackController, QueryController};
use \App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use \App\Http\Controllers\Admin\NewsController as AdminNewsController;
use \App\Http\Controllers\Admin\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', [Controller::class, 'index'])
    ->name('index');

Route::get('/feedback', [FeedbackController::class, 'index'])
    ->name('feedback.index');
Route::get('/feedback/create', [FeedbackController::class, 'create'])
    ->name('feedback.create');


Route::resources([
    '/feedback' => FeedbackController::class,
    '/query' => QueryController::class,
]);

Route::get('/query/create', [QueryController::class, 'create'])
    ->name('query.create');

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');
// биндинг модели передает конкретную модель в метод show, для этого нужно, чтобы нахвание параметра
// {news} совпадало с классом news
Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news', '\d+')
    ->name('news.show');

Route::get('/news/categories/{category_id}', [NewsController::class, 'showByCat'])
    ->where('category_id', '\d+')
    ->name('news.categories.show');
Route::get('/auth', [AuthController::class, 'index'])
    ->name('auth');

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function(){
    Route::resources([
        '/categories' => AdminCategoryController::class,
        '/news'=> AdminNewsController::class,
        ]
    );
    Route::get('/categories', [AdminCategoryController::class, 'index'])
        ->name('categories');
    Route::get('/news', [AdminNewsController::class, 'index'])
        ->name('news');
    Route::get('/news/create', [AdminNewsController::class, 'create'])
    ->name('news.create');
    Route::get('/', [AdminController::class, 'index'])
        ->name('index');
});



