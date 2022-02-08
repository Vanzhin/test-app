<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\{NewsController, Controller, CategoryController, FeedbackController, QueryController, HomeController};
use \App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use \App\Http\Controllers\Admin\NewsController as AdminNewsController;
use \App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;

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


Route::get('/', [Controller::class, 'index'])
    ->name('index');

Route::get('/feedbacks', [FeedbackController::class, 'index'])
    ->name('feedbacks.index');
Route::get('/feedbacks/create', [FeedbackController::class, 'create'])
    ->name('feedbacks.create');


Route::resources([
    '/feedbacks' => FeedbackController::class,
    '/query' => QueryController::class,
]);

Route::get('/query/create', [QueryController::class, 'create'])
    ->name('query.create');

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');
// биндинг модели передает конкретную модель в метод show, для этого нужно, чтобы название параметра
// {news} совпадало с классом news
Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news', '\d+')
    ->name('news.show');

Route::get('/news/categories/{category}', [NewsController::class, 'indexByCat'])
    ->where('category', '\d+')
    ->name('news.categories.show');



Route::group(['as' => 'admin.', 'prefix' => 'admin'], function(){
    Route::resources([
        '/categories' => AdminCategoryController::class,
        '/news'=> AdminNewsController::class,
        ]
    );
//    пришлось забивать параметры в ручную ибо по другому выходила ошибка
    Route::resource('feedbacks', AdminFeedbackController::class,
    )
        ->parameters(['feedbacks' => 'feedback']);

    Route::get('/categories', [AdminCategoryController::class, 'index'])
        ->name('categories');
    Route::get('/feedbacks', [AdminFeedbackController::class, 'index'])
        ->name('feedbacks');
    Route::get('/news', [AdminNewsController::class, 'index'])
        ->name('news');
    Route::get('/news/create', [AdminNewsController::class, 'create'])
    ->name('news.create');
    Route::get('/', [AdminController::class, 'index'])
        ->name('index');
});




Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
