<?php

namespace App\Http\Controllers;

use CupOfThea\MarkdownBlog\Domain\UseCases\Queries\GetPostQuery;
use CupOfThea\MarkdownBlog\Domain\ValueObjects\Post;
use Illuminate\Contracts\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class DisplayPostController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(string $slug): View
    {
        return view('posts.show', [
            'post' => app(GetPostQuery::class)->get($slug),
        ]);
    }
}
