<?php

namespace Tests\Feature\PostsSynchronizer;

use App\Console\Commands\PostsSynchronizer\SynchronizeCommand;
use App\Models\Category;
use App\Models\Post;

it('creates new categories from files', function () {
    expect(Category::count())->toBe(0);

    $content = file_get_contents(__DIR__ . '/posts/test-category.md');

    SynchronizeCommand::generate($content, '/posts/test-category.md');

    expect(Category::count())->toBe(1);

    $category = Category::first();

    expect($category->title)->toBe('Perso')
        ->and($category->slug)->toBe('perso')
        ->and($category->posts()->count())->toBe(1);

    $post = Post::first();

    expect($post->category->title)->toBe($category->title);

    $content = file_get_contents(__DIR__ . '/posts/test-same-category.md');

    SynchronizeCommand::generate($content, '/posts/test-same-category.md');

    $post = Post::where('slug', 'other-slug')->first();

    expect($post->category->title)->toBe($category->title)
        ->and($category->posts->count())->toBe(2);
});
