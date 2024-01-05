<?php

namespace App\Console\Commands\PostsSynchronizer;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SynchronizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts-synchronizer:synchronize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize posts from storage to database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Post created successfully.');

        collect(Storage::allFiles('posts'))->each(function (string $path) {
            $this->generate(Storage::get($path));
        });

        return Command::SUCCESS;
    }

    public static function generate(string $content): void
    {

        $post = MarkdownPost::parse($content);

        Post::create($post->toPostAttributes());
    }
}
