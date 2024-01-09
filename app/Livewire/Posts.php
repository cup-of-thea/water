<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Posts extends Component
{
    #[Computed]
    public function years()
    {
        return Post::orderBy('date', 'desc')->get()
            ->groupBy(function ($post) {
                return $post->date->year;
            });
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
