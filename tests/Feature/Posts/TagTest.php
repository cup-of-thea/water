<?php

use Illuminate\Support\Facades\DB;

test('tags pages', function () {
    DB::table('tags')->insert([
        ['title' => 'Tag 1', 'slug' => 'tag-1', 'created_at' => now(), 'updated_at' => now()],
        ['title' => 'Tag 2', 'slug' => 'tag-2', 'created_at' => now(), 'updated_at' => now()],
        ['title' => 'Tag 3', 'slug' => 'tag-3', 'created_at' => now(), 'updated_at' => now()],
    ]);

    DB::table('posts')->insert([
        ['title' => 'Post 2021 1', 'slug' => 'post-2021-1', 'filepath' => 'post-2021-1.md', 'date' => '2021-01-01', 'created_at' => now(), 'updated_at' => now()],
        ['title' => 'Post 2022 1', 'slug' => 'post-2022-1', 'filepath' => 'post-2022-1.md', 'date' => '2022-01-01', 'created_at' => now(), 'updated_at' => now()],
        ['title' => 'Post 2022 2', 'slug' => 'post-2022-2', 'filepath' => 'post-2022-2.md', 'date' => '2022-02-01', 'created_at' => now(), 'updated_at' => now()],
        ['title' => 'Post 2023 1', 'slug' => 'post-2023-1', 'filepath' => 'post-2023-1.md', 'date' => '2023-01-01', 'created_at' => now(), 'updated_at' => now()],
        ['title' => 'Post 2023 2', 'slug' => 'post-2023-2', 'filepath' => 'post-2023-2.md', 'date' => '2023-02-01', 'created_at' => now(), 'updated_at' => now()],
        ['title' => 'Post 2023 3', 'slug' => 'post-2023-3', 'filepath' => 'post-2023-3.md', 'date' => '2023-03-01', 'created_at' => now(), 'updated_at' => now()],
    ]);

    DB::table('post_tag')->insert([
        ['post_id' => 1, 'tag_id' => 2],
        ['post_id' => 2, 'tag_id' => 2],
        ['post_id' => 1, 'tag_id' => 3],
        ['post_id' => 2, 'tag_id' => 3],
        ['post_id' => 3, 'tag_id' => 3],
        ['post_id' => 4, 'tag_id' => 3],
        ['post_id' => 5, 'tag_id' => 3],
        ['post_id' => 6, 'tag_id' => 3],
    ]);

    $this->get(route('tags.index'))
        ->assertOk()
        ->assertSeeTextInOrder([
            'Tag 1', '0 articles',
            'Tag 2', '2 article',
            'Tag 3', '6 articles'
        ]);

    $this->get(route('tags.show', 'tag-3'))
        ->assertOk()
        ->assertSee('Tag 3')
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
