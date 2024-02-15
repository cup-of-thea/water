<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/categories/',
    function () {
        return view('categories.index', ['categories' => Category::orderBy('title')->get()]);
    }
)->name('categories.index');

Route::get(
    '/categories/{category:slug}',
    function (Category $category) {
        return view('categories.show', compact('category'));
    }
)->name('categories.show');

Route::get(
    '/posts/',
    function () {
        return view('posts.index');
    }
)->name('posts.index');

Route::get(
    '/posts/{post:slug}',
    function (Post $post) {
        return view('posts.show', compact('post'));
    }
)->name('posts.show');
