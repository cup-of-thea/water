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



            <ul class="list-none p-0 flex justify-end space-x-4">


                <li class="m-0 p-0">
                    <a href="/categories/perso">
                        Perso
                    </a>
                </li>




                <li class="m-0 p-0">
                    <a href="/tags/communaute">
                        #Communauté
                    </a>
                </li>

                <li class="m-0 p-0">
                    <a href="/tags/2024">
                        #2024
                    </a>
                </li>


            </ul>


            <p>Table des matières</p>
            <ul>

                <li>
                    <a href="https://cupof.coffee/posts/reading-challenge-2024/#d-ou-vient-l-idee">D'où vient l'idée ?</a>

                </li>

                <li>
                    <a href="https://cupof.coffee/posts/reading-challenge-2024/#la-liste">La liste</a>

                    <ul>

                        <li>
                            <a href="https://cupof.coffee/posts/reading-challenge-2024/#bds-manga-et-romans-graphiques">BDs, manga et romans graphiques</a>
                        </li>

                        <li>
                            <a href="https://cupof.coffee/posts/reading-challenge-2024/#romans-et-nouvelles">Romans et nouvelles</a>
                        </li>

                        <li>
                            <a href="https://cupof.coffee/posts/reading-challenge-2024/#essais">Essais</a>
                        </li>

                        <li>
                            <a href="https://cupof.coffee/posts/reading-challenge-2024/#netflix">Netflix</a>
                        </li>

                    </ul>

                </li>

            </ul>
            <hr>

            {!! $post->content !!}

        </article>

    </section>
</x-layout>
