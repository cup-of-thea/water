<?php

namespace App\Console\Commands\PostsSynchronizer;

class RemoveMeta
{
    public function __invoke(string $content, \Closure $next)
    {
        $content = str($content)->afterLast('---')->trim()->toString();

        return $next($content);
    }
}
