<?php

namespace App\Http\Controllers;

use Thea\MarkdownBlog\Domain\UseCases\Queries\GetPostQuery;
use Illuminate\Contracts\View\View;

readonly final class DisplayPostController
{
    public function __construct(
        private GetPostQuery $getPostQuery
    )
    {
    }

    public function __invoke(string $slug): View
    {
        return view('posts.show', [
            'post' => $this->getPostQuery->get($slug),
        ]);
    }
}
