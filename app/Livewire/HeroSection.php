<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class HeroSection extends Component
{
    public $content;
    public $avatarPath;

    public function render()
    {
        $this->avatarPath = Storage::url("public/content/hero-section/avatar.jpg");
        $this->content = app(MarkdownRenderer::class)->toHtml(Storage::get('content/hero-section/index.md'));
        return view('livewire.hero-section');
    }
}
