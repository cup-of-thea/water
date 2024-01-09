<?php

use App\Livewire\Posts;
use App\Models\Category;
use App\Models\Post;
use function Pest\Livewire\livewire;

test('categories page can be accessed', function () {
    Category::factory(3)->create();

    $categories = Category::orderBy('title')->get();

    $this->get(route('categories.index'))
        ->assertOk()
        ->assertSeeTextInOrder($categories->pluck('title')->toArray());
});

test('category page can be accessed', function () {
    $category = Category::factory()->create();

    $this->get(route('categories.show', $category))
        ->assertOk()
        ->assertSee($category->title);
});

