<?php

use App\Livewire\Posts;
use App\Models\Post;
use function Pest\Livewire\livewire;

test('post page can be accessed', function () {
    $post = Post::factory()->create();

    $this->get(route('posts.show', $post))
        ->assertOk()
        ->assertSee($post->title)
        ->assertSee($post->content);
});

it('groups posts by year', function () {
    Post::factory(['date' => '2021-01-01'])->create();
    Post::factory(['date' => '2022-01-01'])->create();
    Post::factory(['date' => '2022-01-01'])->create();
    Post::factory(['date' => '2023-01-01'])->create();
    Post::factory(['date' => '2023-01-01'])->create();
    Post::factory(['date' => '2023-01-01'])->create();
    livewire(Posts::class)
        ->assertSee('2021 (1)')
        ->assertSee('2022 (2)')
        ->assertSee('2023 (3)');
});
