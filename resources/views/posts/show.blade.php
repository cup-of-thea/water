<x-layout>
    <section class="lg:max-w-2xl py-24 px-8 lg:px-4 w-full text-gray-900 dark:text-gray-300 text-justify">

        <article class="prose dark:prose-invert lg:prose-lg
    dark:text-gray-300 dark:prose-headings:text-gray-300
    dark:prose-strong:text-gray-300
    prose-a:text-red-400
    dark:prose-a:text-blue-400
    ">

            <header>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300 sm:text-3xl">
                    {{ $post->title }}
                </h1>
            </header>

            <livewire:post-taxonomies :post="$post" />

            {!! $post->content !!}

        </article>

    </section>
</x-layout>
