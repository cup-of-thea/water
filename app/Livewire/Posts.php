<?php

namespace App\Livewire;

use App\Models\Post;
use Carbon\Carbon;
use Livewire\Component;

class Posts extends Component
{
    public $posts = [];

    public function render()
    {
        $this->posts = Post::orderBy('date', 'desc')->get();
        return view('livewire.posts');
    }
}
