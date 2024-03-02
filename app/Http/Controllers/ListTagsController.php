<?php

namespace App\Http\Controllers;

use Thea\MarkdownBlog\Domain\UseCases\Queries\IndexTagsQuery;
use Illuminate\Contracts\View\View;

readonly class ListTagsController
{
    public function __construct(
        private IndexTagsQuery $indexTagsQuery
    )
    {
    }

    public function __invoke(): View
    {
        return view('tags.index', ['tags' => $this->indexTagsQuery->index()]);
    }
}
