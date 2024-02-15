<?php

use App\Livewire\Posts;
use App\Models\Post;
use function Pest\Livewire\livewire;

test('posts page can be accessed', function () {
    Post::factory()->create(['title' => 'Post 1', 'date' => '2021-01-01']);
    Post::factory()->create(['title' => 'Post 2', 'date' => '2022-01-01']);
    Post::factory()->create(['title' => 'Post 3', 'date' => '2023-01-01']);

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSeeTextInOrder(['Post 3', 'Post 2', 'Post 1']);
});


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
