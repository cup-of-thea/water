<?php

use App\Models\Post;

test('one can access post page', function () {
    $post = Post::factory()->create();

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee($post->title)
        ->assertSee($post->content);
});