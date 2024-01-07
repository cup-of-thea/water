<div>
    @foreach($posts as $post)
        <a class="flex flex-col sm:flex-row sm:justify-between sm:items-start border-b border-b-gray-400 py-4 no-underline text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="/posts/{{ $post->slug }}">
            <p class="m-0">{{ $post->title }}</p>
            <div class="flex flex-col justify-end items-end">
                <time class="text-sm sm:text-base" datetime="{{ (new \Carbon\Carbon($post->date))->toDateString() }}">
                    {{ $post->date->locale('fr')->isoFormat('LL') }}
                </time>
                <small class="m-0">

                    Perso

                </small>
            </div>
        </a>
    @endforeach
</div>
