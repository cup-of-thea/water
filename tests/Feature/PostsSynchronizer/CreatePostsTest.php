<?php

namespace Tests\Feature\PostsSynchronizer;

use App\Console\Commands\PostsSynchronizer\SynchronizeCommand;
use App\Exceptions\SlugIsAlreadyTakenException;
use App\Models\Post;

it('creates post from md file', function () {
    expect(Post::count())->toBe(0);

    $content = file_get_contents(__DIR__ . '/posts/test.md');

    SynchronizeCommand::generate($content, '/posts/test.md');

    expect(Post::count())->toBe(1);

    $post = Post::first();

    expect($post->title)->toBe('Hello 2024 !')
        ->and($post->slug)->toBe('hello-2024')
        ->and($post->content)->toBe(str($content)->afterLast('---')->trim()->toString())
        ->and($post->filePath)->toBe('/posts/test.md');

    $content = file_get_contents(__DIR__ . '/posts/another-test.md');

    SynchronizeCommand::generate($content, '/posts/another-test.md');

    expect(Post::count())->toBe(2);

    $post = Post::where('slug', 'another-test')->first();

    expect($post->title)->toBe('Another test')
        ->and($post->slug)->toBe('another-test')
        ->and($post->content)->toBe(str($content)->afterLast('---')->trim()->toString())
        ->and($post->filePath)->toBe('/posts/another-test.md');
});

it('updates a post if same file path', function () {
    expect(Post::count())->toBe(0);

    $content = file_get_contents(__DIR__ . '/posts/test.md');

    SynchronizeCommand::generate($content, '/posts/test.md');

    expect(Post::count())->toBe(1);

    $content = file_get_contents(__DIR__ . '/posts/test-update.md');

    SynchronizeCommand::generate($content, '/posts/test.md');

    expect(Post::count())->toBe(1);
});

it('throws an error when two files have the same slug', function () {
    expect(Post::count())->toBe(0);

    $content = file_get_contents(__DIR__ . '/posts/test.md');

    SynchronizeCommand::generate($content, '/posts/test.md');

    expect(Post::count())->toBe(1);

    $content = file_get_contents(__DIR__ . '/posts/test-same-slug.md');

    SynchronizeCommand::generate($content, '/posts/test-same-slug.md');

    expect(Post::count())->toBe(1);
})->throws(SlugIsAlreadyTakenException::class, 'The slug hello-2024 is already taken : see /posts/test.md and /posts/test-same-slug.md');
