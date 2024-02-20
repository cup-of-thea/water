<x-layout>

    <section class="lg:max-w-2xl py-24 px-8 lg:px-4 w-full text-gray-900 dark:text-gray-300">
        <livewire:taxonomies />

            <header>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300 sm:text-3xl">
                    Catégories
                </h1>
            </header>

            @foreach($tags as $tag)
                <a class="flex justify-between items-center border-b border-b-gray-400 py-4 no-underline text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100"
                   href="{{ route('tags.show', $tag->slug) }}">
                    <p class="m-0">{{ $tag->title }}</p>
                    <p class="m-0">
                        <x-posts-count :count="$tag->postCount" />
                    </p>
                </a>
            @endforeach

    </section>
</x-layout>
