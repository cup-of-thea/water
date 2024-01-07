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
            {{ $slot }}
        </main>
    </body>
</html>
