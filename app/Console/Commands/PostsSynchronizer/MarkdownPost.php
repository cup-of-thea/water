<?php

namespace App\Console\Commands\PostsSynchronizer;

use Symfony\Component\Yaml\Yaml;

class MarkdownPost
{
    public static function parse(string $content): self
    {
        $meta = Yaml::parse(str($content)->after('---')->before('---')->trim()->toString());
        $content = str($content)->afterLast('---')->trim()->toString();

        return new self(
            title: $meta['title'],
            slug: $meta['slug'],
            content: $content,
        );
    }

    private function __construct(
        private string $title,
        private string $slug,
        private string $content,
    ){}

    public function toPostAttributes(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }
}