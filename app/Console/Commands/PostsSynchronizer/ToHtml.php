<?php

namespace App\Console\Commands\PostsSynchronizer;

use ParsedownExtra;

class ToHtml
{
    public function __invoke(string $content, \Closure $next)
    {
        $content = (new ParsedownExtra())
            ->setBreaksEnabled(false)
            ->setMarkupEscaped(false)
            ->text($content);

        return $next($content);
    }
}
