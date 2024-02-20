<?php

namespace App\Livewire;

use CupOfThea\MarkdownBlog\Domain\UseCases\Queries\GetCategoryFromPostQuery;
use CupOfThea\MarkdownBlog\Domain\UseCases\Queries\GetTagsFromPost;
use CupOfThea\MarkdownBlog\Domain\ValueObjects\Category;
use CupOfThea\MarkdownBlog\Domain\ValueObjects\Post;
use CupOfThea\MarkdownBlog\Domain\ValueObjects\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class PostTaxonomies extends Component
{
    public Post $post;
    public Category $category;
    /** @var Collection<Tag> */
    public Collection $tags;

    private GetCategoryFromPostQuery $getCategoryFromPostQuery;
    private GetTagsFromPost $getTagsFromPost;

    public function boot(
        GetCategoryFromPostQuery $getCategoryFromPostQuery,
        GetTagsFromPost $getTagsFromPost
    ): void
    {
        $this->getCategoryFromPostQuery = $getCategoryFromPostQuery;
        $this->getTagsFromPost = $getTagsFromPost;
    }

    public function render(): View
    {
        return view('livewire.post-taxonomies');
    }

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->category = $this->getCategoryFromPostQuery->get($post);
        $this->tags = $this->getTagsFromPost->get($post);
    }
}
