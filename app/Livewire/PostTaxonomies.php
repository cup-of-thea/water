<?php

namespace App\Livewire;

use CupOfThea\MarkdownBlog\Domain\UseCases\Queries\GetCategoryFromPostQuery;
use CupOfThea\MarkdownBlog\Domain\ValueObjects\Category;
use CupOfThea\MarkdownBlog\Domain\ValueObjects\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PostTaxonomies extends Component
{
    public Post $post;
    public Category $category;

    public function render(): View
    {
        return view('livewire.post-taxonomies');
    }

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->category = app(GetCategoryFromPostQuery::class)->get($post);
    }
}
