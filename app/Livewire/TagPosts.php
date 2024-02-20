<?php

namespace App\Livewire;

use CupOfThea\MarkdownBlog\Domain\ValueObjects\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TagPosts extends Component
{
    public Tag $tag;

    #[Computed]
    public function years(): Collection
    {
        return $this->tag->posts()
            ->groupBy(function ($post) {
                return $post->date->year;
            });
    }

    public function mount($tag): void
    {
        $this->tag = Tag::fromLivewire($tag);
    }


    public function render(): View
    {
        return view('livewire.taxonomy-posts');
    }
}
