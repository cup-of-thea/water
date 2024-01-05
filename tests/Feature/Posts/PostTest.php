<?php

use App\Models\Post;

test('post page can be accessed', function () {
    $post = Post::factory()->create();

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee($post->title)
        ->assertSee($post->content);
});