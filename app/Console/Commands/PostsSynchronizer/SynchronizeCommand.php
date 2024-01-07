<?php

namespace App\Console\Commands\PostsSynchronizer;

use App\Exceptions\SlugIsAlreadyTakenException;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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

        DB::table('posts')->truncate();

        collect(Storage::allFiles('posts'))->each(function (string $path) {
            $this->generate(Storage::get($path), $path);
        });

        return Command::SUCCESS;
    }

    /**
     * @throws SlugIsAlreadyTakenException
     */
    public static function generate(string $content, string $path): void
    {
        $post = MarkdownPost::parse($content, $path);
        self::ensurePostNotDuplicated($post);
        self::saveOrUpdate($post);
    }

    public static function ensurePostNotDuplicated(MarkdownPost $post): void
    {
        if ($originalPost = Post::where('slug', $post->slug)->where('filePath', '!=', $post->filePath)->first()) {
            throw new SlugIsAlreadyTakenException($post->slug, $originalPost->filePath, $post->filePath);
        }
    }

    public static function saveOrUpdate(MarkdownPost $post): void
    {
        if ($originalPost = Post::where('filePath', $post->filePath)->first()) {
            $originalPost->update($post->toPostAttributes());

            return;
        }

        Post::create($post->toPostAttributes());
    }
}
