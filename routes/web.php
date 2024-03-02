<?php

use App\Http\Controllers\DisplayPostController;
use App\Http\Controllers\ListTagsController;
use App\Models\Category;
use Thea\MarkdownBlog\Domain\UseCases\Queries\GetPostQuery;
use Thea\MarkdownBlog\Domain\UseCases\Queries\GetTagQuery;
use Thea\MarkdownBlog\Domain\UseCases\Queries\IndexTagsQuery;
use Thea\MarkdownBlog\Domain\ValueObjects\Post;
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

Route::get('/tags/', ListTagsController::class)->name('tags.index');

Route::get(
    '/tags/{tag:slug}',
    function (string $slug) {
        $tag = app(GetTagQuery::class)->get($slug);
        return view('tags.show', compact('tag'));
    }
)->name('tags.show');

Route::get('/posts/', fn() => view('posts.index'))->name('posts.index');

Route::get('/posts/{slug}', DisplayPostController::class)->name('posts.show');
