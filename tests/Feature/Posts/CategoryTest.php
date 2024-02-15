<?php

use App\Models\Category;
use App\Models\Post;

test('categories page can be accessed', function () {
    Category::factory(3)->create();

    $categories = Category::orderBy('title')->get();

    $this->get(route('categories.index'))
        ->assertOk()
        ->assertSeeTextInOrder($categories->pluck('title')->toArray());
});

test('categories page shows number of posts', function () {
    Category::factory()->create(['title' => 'Catégorie 0']);
    Category::factory()->create(['title' => 'Catégorie 1'])
        ->posts()
        ->saveMany(Post::factory(1)->make());
    Category::factory()
        ->create(['title' => 'Catégorie 2'])
        ->posts()
        ->saveMany(Post::factory(3)->make());

    $this->get(route('categories.index'))
        ->assertOk()
        ->assertSeeTextInOrder([
            'Catégorie 0', '0 articles',
            'Catégorie 1', '1 article',
            'Catégorie 2', '3 articles'
        ]);
});

test('category page can be accessed', function () {
    $category = Category::factory()->create();

    $this->get(route('categories.show', $category))
        ->assertOk()
        ->assertSee($category->title);
});

test('category page shows posts grouped by year', function () {
    $category = Category::factory()->create();

    $category->posts()->saveMany([
        Post::factory()->make(['title' => 'Post 2021 1', 'date' => '2021-01-01']),
        Post::factory()->make(['title' => 'Post 2022 1', 'date' => '2022-01-01']),
        Post::factory()->make(['title' => 'Post 2022 2', 'date' => '2022-01-02']),
        Post::factory()->make(['title' => 'Post 2023 1', 'date' => '2023-01-01']),
        Post::factory()->make(['title' => 'Post 2023 2', 'date' => '2023-01-02']),
        Post::factory()->make(['title' => 'Post 2023 3', 'date' => '2023-01-03']),
    ]);

    $this->get(route('categories.show', $category))
        ->assertOk()
        ->assertSee($category->title)
        ->assertSeeInOrder([
            '2023 (3)',
            'Post 2023 3',
            'Post 2023 2',
            'Post 2023 1',
            '2022 (2)',
            'Post 2022 2',
            'Post 2022 1',
            '2021 (1)',
            'Post 2021 1',
        ])
    ;
});
