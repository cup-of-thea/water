<?php

use App\Models\Category;
use App\Models\Post;
use CupOfThea\MarkdownBlog\Domain\UseCases\Queries\GetPostQuery;
use CupOfThea\MarkdownBlog\Domain\UseCases\Queries\GetTagQuery;
use CupOfThea\MarkdownBlog\Domain\UseCases\Queries\IndexTagsQuery;
use Illuminate\Support\Facades\DB;
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
    '/tags/',
    function () {
        $tags = app(IndexTagsQuery::class)->index();
        return view('tags.index', compact('tags'));
    }
)->name('tags.index');

Route::get(
    '/tags/{tag:slug}',
    function (string $slug) {
        $tag = app(GetTagQuery::class)->get($slug);
        return view('tags.show', compact('tag'));
    }
)->name('tags.show');

Route::get(
    '/posts/',
    function () {
        return view('posts.index');
    }
)->name('posts.index');

Route::get(
    '/posts/{post:slug}',
    function (string $slug) {
        $post = app(GetPostQuery::class)->get($slug);
        return view('posts.show', compact('post'));
    }
)->name('posts.show');
