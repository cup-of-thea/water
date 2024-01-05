<?php

namespace Tests\Feature\PostsSynchronizer;

use App\Console\Commands\PostsSynchronizer\SynchronizeCommand;
use App\Models\Post;

it('creates post from md file', function () {
    expect(Post::count())->toBe(0);

    $content = file_get_contents(__DIR__ . '/posts/test.md');

    SynchronizeCommand::generate($content);

    expect(Post::count())->toBe(1);
    
    $post = Post::first();

    expect($post->title)->toBe('Hello 2024 !');
    expect($post->slug)->toBe('hello-2024');
    expect($post->content)->toBe(str($content)->afterLast('---')->trim()->toString());

    $content = file_get_contents(__DIR__ . '/posts/another-test.md');

    SynchronizeCommand::generate($content);

    expect(Post::count())->toBe(2);
    
    $post = Post::where('slug', 'another-test')->first();

    expect($post->title)->toBe('Another test');
    expect($post->slug)->toBe('another-test');
    expect($post->content)->toBe(str($content)->afterLast('---')->trim()->toString());
});
