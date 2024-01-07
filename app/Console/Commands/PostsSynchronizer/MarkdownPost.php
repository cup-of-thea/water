<?php

namespace App\Console\Commands\PostsSynchronizer;

use Symfony\Component\Yaml\Yaml;

class MarkdownPost
{
    public static function parse(string $content, string $filePath): self
    {
        $meta = Yaml::parse(str($content)->after('---')->before('---')->trim()->toString());
        $content = str($content)->afterLast('---')->trim()->toString();
        $slug = $meta['slug'] ?? str($filePath)
            ->afterLast('/')
            ->trim()
            ->replace(' ', '-')
            ->before('.');

        return new self(
            title: $meta['title'],
            slug: $slug,
            content: $content,
            filePath: $filePath,
        );
    }

    private function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly string $content,
        public readonly string $filePath,
    ){}

    public function toPostAttributes(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'filePath' => $this->filePath,
        ];
    }
}
