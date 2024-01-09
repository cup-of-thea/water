<?php

namespace App\Console\Commands\PostsSynchronizer;

use Carbon\Carbon;
use Illuminate\Support\Facades\Pipeline;
use Symfony\Component\Yaml\Yaml;

class MarkdownPost
{
    public static function parse(string $content, string $filePath, mixed $meta): self
    {
        $content = Pipeline::send($content)
            ->through([
                RemoveMeta::class,
                ToHtml::class
            ])
            ->thenReturn();

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
            date: new Carbon($meta['date'])
        );
    }

    private function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly string $content,
        public readonly string $filePath,
        public readonly Carbon $date,
    ){}

    public function toPostAttributes(): array
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'filePath' => $this->filePath,
            'date' => $this->date->locale('fr'),
        ];
    }
}
