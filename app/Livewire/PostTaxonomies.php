<?php

namespace App\Livewire;

use Thea\MarkdownBlog\Domain\UseCases\Queries\GetCategoryFromPostQuery;
use Thea\MarkdownBlog\Domain\UseCases\Queries\GetTagsFromPost;
use Thea\MarkdownBlog\Domain\ValueObjects\Category;
use Thea\MarkdownBlog\Domain\ValueObjects\Post;
use Thea\MarkdownBlog\Domain\ValueObjects\Tag;
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
