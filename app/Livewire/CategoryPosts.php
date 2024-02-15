<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class CategoryPosts extends Component
{
    public $category;

    #[Computed]
    public function years()
    {
        return $this->category->posts()
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(function ($post) {
                return $post->date->year;
            });
    }

    public function mount($category)
    {
        $this->category = $category;
    }


    public function render()
    {
        return view('livewire.category-posts');
    }
}
