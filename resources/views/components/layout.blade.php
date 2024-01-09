<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>Blog</title>
    </head>
    <body class="font-mono text-gray-900 antialiased">
        <main class="relative flex justify-center min-h-screen bg-gray-50 dark:bg-gray-900 py-4 sm:pt-0">
            <header>
                <nav class="absolute text-lg top-0 left-0 right-0 p-4 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-300">
                    <div class="mx-auto lg:max-w-xl">
                        <ul class="flex flex-wrap justify-end space-x-4">
                            <li><a href="/">/home/</a></li>
                            <li><a href="/posts">/articles/</a></li>
                            <li><a href="/reviews">/revues/</a></li>
                            <li><a href="/stories">/histoires/</a></li>
                            <li><a href="/thea">/thea/</a></li>
                        </ul>
                    </div>
                </nav>
            </header>
            {{ $slot }}
        </main>
    </body>
</html>
