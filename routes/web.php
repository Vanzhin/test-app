<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\{NewsController, Controller, CategoryController, AuthController};
use \App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use \App\Http\Controllers\Admin\NewsController as AdminNewsController;
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


Route::get('/', [Controller::class, 'index']);

Route::get('/auth', [AuthController::class, 'index'])
    ->name('auth.index');

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');
Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');

Route::get('/news/categories/{category_id}', [NewsController::class, 'showByCat'])
    ->where('category_id', '\d+')
    ->name('news.categories.show');

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function(){
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/news', AdminNewsController::class);
});



